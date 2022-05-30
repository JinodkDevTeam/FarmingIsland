<?php
declare(strict_types=1);

namespace NgLam2911\PlayerProfile;

class Profile{

	protected string $name;
	protected int $id;

	public function __construct(string $name, int $id){
		$this->name = $name;
		$this->id = $id;
	}

	public function getName() : string{
		return $this->name;
	}

	public function getId() : int{
		return $this->id;
	}
}