<?php
declare(strict_types=1);

namespace CustomItems\item;

class MetaLessIdentifier{
	protected int $id;
	protected int $meta;

	public function __construct(int $id, int $meta){
		$this->id = $id;
		$this->meta = $meta;
	}

	/**
	 * @return int
	 */
	public function getId(): int{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getMeta(): int{
		return $this->meta;
	}
}