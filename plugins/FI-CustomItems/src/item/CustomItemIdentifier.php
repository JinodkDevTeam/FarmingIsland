<?php
declare(strict_types=1);

namespace CustomItems\item;

class CustomItemIdentifier{
	protected string $id;

	public function __construct(string $id){
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getNamespaceId() : string{
		return $this->id;
	}
}
