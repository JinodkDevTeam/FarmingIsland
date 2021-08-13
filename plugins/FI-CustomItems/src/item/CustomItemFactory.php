<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\utils\SingletonTrait;
use RuntimeException;

class CustomItemFactory{
	use SingletonTrait;

	/** @var CustomItem[] */
	private array $list = [];

	/**
	 * @param CustomItem $item
	 * @param bool       $overwrite
	 * @throws RuntimeException
	 */
	public function register(CustomItem $item, bool $overwrite = false): void{
		$id = $item->getId();
		if (isset($this->list[$id]) && (!$overwrite)){
			throw new RuntimeException("Trying to overwrite an already registered item !");
		}
		$this->list[$id] = clone $item;
	}

	public function isRegistered(int $id): bool{
		if (isset($this->list[$id])){
			return true;
		}
		return false;
	}

	public function get(int $id): ?CustomItem{
		if (isset($this->list[$id])){
			return $this->list[$id];
		}
		return null;
	}

	public function __construct(){
		//Register custom items
		$this->register(new EnchantedCobblestone(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COBBLESTONE), "Enchanted Cobblestone", RarityType::COMMON));
		$this->register(new EnchantedCoal(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL), "Enchanted Coal", RarityType::COMMON));
		$this->register(new EnchantedCoalBlock(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL_BLOCK), "Enchanted Coal Block", RarityType::UNCOMMON));
		$this->register(new EnchantedIronIngot(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_INGOT), "Enchanted Iron Ingot", RarityType::COMMON));
		$this->register(new EnchantedIronBlock(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_BLOCK), "Enchanted Iron Block", RarityType::UNCOMMON));
		$this->register(new EnchantedGoldIngot(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_INGOT), "Enchanted Gold Ingot", RarityType::COMMON));
		$this->register(new EnchantedGoldBlock(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_BLOCK), "Enchanted Gold Block", RarityType::UNCOMMON));
		$this->register(new EnchantedLapis(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS), "Enchanted Lapis Lazuli", RarityType::COMMON));
		$this->register(new EnchantedLapisBlock(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS_BLOCK), "Enchanted Lapis Block", RarityType::UNCOMMON));

		$this->register(new RefinedDiamond(new CustomItemIdentifier(CustomItemIds::REFINED_DIAMOND), "Refined Diamond", RarityType::RARE));
		$this->register(new NoicePaper(new CustomItemIdentifier(CustomItemIds::NOICE_PAPER), "Noice Paper", RarityType::LEGENDARY));
	}
}