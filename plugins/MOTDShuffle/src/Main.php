<?php
declare(strict_types=1);

namespace MOTDShuffle;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase
{
	public Config $config;

	public function onEnable(): void
	{
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");        
        $this->config = new Config($this->getdatafolder() . "config.yml", Config::YAML);
        if (is_int($this->getMainConfig()->get("MOTD Delay")) == true)
        {
            $this->getScheduler()->scheduleRepeatingTask(new SendMOTD($this), $this->getMainConfig()->get("MOTD Delay"));
        }
        else
        {
            $this->getLogger()->info("§4The value you entered in §c'MOTD Delay' §4is not an integer. Please fix it.");
        } 
    }

    public function getMainConfig(): Config
	{
        return $this->config;
    }
}