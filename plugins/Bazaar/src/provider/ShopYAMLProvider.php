<?php
declare(strict_types=1);

namespace Bazaar\provider;

use Bazaar\Bazaar;
use JsonException;
use pocketmine\utils\Config;

class ShopYAMLProvider implements Provider{

	protected Config $data;
	private Bazaar $bazaar;

	public function __construct(Bazaar $bazaar){
		$this->bazaar = $bazaar;
	}

	private function getBazaar() : Bazaar{
		return $this->bazaar;
	}

	public function init() : void{
		$this->getBazaar()->saveResource("shop.yml");
		$this->data = new Config($this->getBazaar()->getDataFolder() . "shop.yml", Config::YAML);
	}

	/**
	 * @throws JsonException
	 */
	public function close() : void{
		$this->data->save();
	}

	public function getAll(): array{
		return $this->data->getAll();
	}
}