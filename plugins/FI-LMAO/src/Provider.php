<?php
declare(strict_types=1);

namespace LMAO;

use JsonException;
use pocketmine\utils\Config;

class Provider{

	protected Loader $loader;
	protected Config $config;

	protected function getLoader() : Loader{
		return $this->loader;
	}

	protected function init() : void{
		$this->getLoader()->saveResource("config.yml");
		$this->config = new Config($this->getLoader()->getDataFolder() . "config.yml", Config::YAML);
	}

	public function __construct(Loader $loader){
		$this->loader = $loader;
		$this->init();
	}

	public function get(string $key) : mixed{
		return $this->config->get($key);
	}

	public function getAll() : array{
		return $this->config->getAll();
	}

	public function set(string $key, mixed $value){
		$this->config->set($key, $value);
		try{
			$this->config->save();
		}catch(JsonException){
			$this->getLoader()->getLogger()->error("Unable to save config data !");
		}
	}
}