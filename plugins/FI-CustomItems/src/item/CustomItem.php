<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\Rarity;
use pocketmine\block\Block;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\entity\Entity;
use pocketmine\entity\Human;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class CustomItem{

	protected CustomItemIdentifier $identifier;
	protected string $name;
	protected Rarity $rarity;

	public function __construct(CustomItemIdentifier $identifier, string $name, Rarity $rarity){
		$this->identifier = $identifier;
		$this->name = $name;
		$this->rarity = $rarity;
	}

	/**
	 * @return Item
	 * @description Convert to Item
	 */
	public function toItem() : Item{
		return ItemFactory::air();
	}

	public function getId() : int{
		return $this->getItemIdentifier()->getId();
	}

	public function getItemIdentifier() : CustomItemIdentifier{
		return $this->identifier;
	}

	public function getName() : string{
		return $this->name;
	}

	public function getRarity() : Rarity{
		return $this->rarity;
	}

	public function setEnchantGlint(Item $item) : Item{
		$item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(100), 1));
		return $item;
	}

	public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
		return ItemUseResult::NONE();
	}

	public function onClickAir(Player $player, Vector3 $directionVector) : ItemUseResult{
		return ItemUseResult::NONE();
	}

	public function onReleaseUsing(Player $player) : ItemUseResult{
		return ItemUseResult::NONE();
	}

	public function onDestroyBlock(Player $player, Block $block) : ItemUseResult{
		return ItemUseResult::NONE();
	}

	public function onAttackEntity(Human $damager, Entity $victim) : ItemUseResult{
		return ItemUseResult::NONE();
	}

	public function onInteractEntity(Player $player, Entity $target, Vector3 $clickVector) : ItemUseResult{
		return ItemUseResult::NONE();
	}
	public function onPlace(Player $player, Block $block, Block $blockreplaced, Block $blockagains): ItemUseResult{
		return ItemUseResult::FAIL();
	}

}