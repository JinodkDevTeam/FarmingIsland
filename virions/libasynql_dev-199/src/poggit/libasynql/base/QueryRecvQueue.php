<?php

/*
 * libasynql
 *
 * Copyright (C) 2018 SOFe
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace poggit\libasynql\base;

use poggit\libasynql\SqlError;
use poggit\libasynql\SqlResult;
use ThreadedBase;
use ThreadedArray;
use function is_string;
use function serialize;
use function unserialize;

class QueryRecvQueue extends ThreadedBase{
	private ThreadedArray $queue;

	public function __construct(){
		$this->queue = new ThreadedArray();
	}

	/**
	 * @param SqlResult[] $results
	 */
	public function publishResult(int $queryId, array $results) : void{
		$this->synchronized(function() use ($queryId, $results) : void{
			$this->queue[] = serialize([$queryId, $results]);
			$this->notify();
		});
	}

	public function publishError(int $queryId, SqlError $error) : void{
		$this->synchronized(function() use ($error, $queryId) : void{
			$this->queue[] = serialize([$queryId, $error]);
			$this->notify();
		});
	}

	public function fetchResults(&$queryId, &$results) : bool{
		if(is_string($row = $this->queue->shift())){
			[$queryId, $results] = unserialize($row, ["allowed_classes" => true]);
			return true;
		}
		return false;
	}

	/**
	 * @return list<array{int, SqlError|SqlResult[]|null}>
	 */
	public function fetchAllResults(): array{
		return $this->synchronized(function(): array{
			$ret = [];
			while($this->fetchResults($queryId, $results)){
				$ret[] = [$queryId, $results];
			}
			return $ret;
		});
	}

	/**
	 * @return list<array{int, SqlError|SqlResult[]|null}>
	 */
	public function waitForResults(int $expectedResults): array{
		return $this->synchronized(function() use ($expectedResults) : array{
			$ret = [];
			while(count($ret) < $expectedResults){
				if(!$this->fetchResults($queryId, $results)){
					$this->wait();
					continue;
				}
				$ret[] = [$queryId, $results];
			}
			return $ret;
		});
	}
}
