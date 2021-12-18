<?php
declare(strict_types=1);

namespace TestPlugin;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;
use TestPlugin\entity\SpinBlockEntity;

class Loader extends PluginBase{

	public function onEnable() : void{
		EntityFactory::getInstance()->register(SpinBlockEntity::class, function(World $world, CompoundTag $nbt) : SpinBlockEntity{
			return new SpinBlockEntity(EntityDataHelper::parseLocation($nbt, $world), $nbt);
		}, ['Zombie', 'minecraft:zombie'], EntityLegacyIds::ZOMBIE);
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch(strtolower($command->getName())){
			case "smtest":
				if ($sender instanceof Player){
					$entity = new SpinBlockEntity($sender->getLocation());
					$entity->spawnToAll();
				}
				break;
			case "lol":
				//NOThing
				break;
		}
		return true;
	}
}