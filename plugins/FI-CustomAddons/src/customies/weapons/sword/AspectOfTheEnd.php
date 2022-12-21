<?php
declare(strict_types=1);

namespace CustomAddons\customies\weapons\sword;

use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\block\Liquid;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\EndermanTeleportSound;

class AspectOfTheEnd extends Sword{

	public function getTexture() : string{
		return "fici_aspect_of_the_end";
	}

	public function getBaseDamage() : int{
		return 100;
	}

	public function onClickAir(Player $player, Vector3 $directionVector) : ItemUseResult{
		$this->teleport($player);
		return ItemUseResult::SUCCESS();
	}

	public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
		$this->teleport($player);
		return ItemUseResult::SUCCESS();
	}

	public function teleport(Player $player){
		$direction = $player->getDirectionVector();
		$pos = $player->getPosition();
		$world = $player->getWorld();
		$blocked = false;
		for($i = 1; $i <= 8; $i++){
			$pos = $pos->addVector($direction);

			if((!$world->getBlock($pos) instanceof Air) and (!$world->getBlock($pos) instanceof Liquid)){
				$pos = $pos->subtractVector($direction);
				$blocked = true;
				break;
			}
		}
		if ($blocked){
			$player->sendMessage("§r§7There are blocks in the way!");
		}
		$player->teleport($pos);
		$world->addSound($pos, new EndermanTeleportSound(), [$player]);
	}
}