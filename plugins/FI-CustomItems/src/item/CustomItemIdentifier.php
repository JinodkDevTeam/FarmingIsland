<?php
declare(strict_types=1);

namespace CustomItems\item;

class CustomItemIdentifier{
	protected int $id;

	public function __construct(int $id){
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId() : int{
		return $this->id;
	}
}
