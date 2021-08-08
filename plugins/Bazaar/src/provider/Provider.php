<?php
declare(strict_types=1);

namespace Bazaar\provider;

interface Provider{

	public function init(): void;

	public function close(): void;
}