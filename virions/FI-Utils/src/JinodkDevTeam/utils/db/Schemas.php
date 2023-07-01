<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils\db;

use Attribute;

#[Attribute]
class Table{
	public function __construct(protected ?string $name){ }

	public function getName() : ?string{
		return $this->name;
	}
}

#[Attribute]
class Key {}

#[Attribute]
class NotNull {}

#[Attribute]
class Required {}

#[Attribute]
class Unique {}

#[Attribute]
class AutoIncrement {}