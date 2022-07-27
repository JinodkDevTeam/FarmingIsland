<?php
declare(strict_types=1);

namespace CustomItems\item;

class CustomItemIdentifier{
	protected string $id;

	public function __construct(string|int $id){
		$this->id = (string)$id;
	}

	/**
	 * @return string
	 */
	public function getNamespaceId() : string{
		return $this->id;
	}
}
