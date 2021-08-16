<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\item\ItemIds;
use pocketmine\utils\SingletonTrait;
use RuntimeException;

class CustomItemFactory{
	use SingletonTrait;

	/** @var CustomItem[] */
	private array $list = [];
	/** @var MetaLessItem[] */
	private array $mlist = [];

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

	public function registerMetaLess(MetaLessItem $item, bool $overwrite = false): void{
		$id = $item->getMetaLessIdentifier()->getId();
		$meta = $item->getMetaLessIdentifier()->getMeta();
		if (isset($this->mlist[$id . ":" . $meta]) && (!$overwrite)){
			throw new RuntimeException("Trying to overwrite an already registered item !");
		}
		$this->list[$id . ":" . $meta] = clone $item;

		$this->register($item);
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

	public function getMetaLessItem(int $id, int $meta): ?MetaLessItem{
		if (isset($this->mlist[$id . ":" . $meta])){
			return $this->mlist[$id . ":" . $meta];
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
		$this->register(new EnchantedRedstone(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE), "Enchanted Redstone Dust", RarityType::COMMON));
		$this->register(new EnchantedRedstoneBlock(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE_BLOCK), "Enchanted Redstone Block", RarityType::UNCOMMON));
		$this->register(new EnchantedEmerald(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD), "Enchanted Emerald", RarityType::COMMON));
		$this->register(new EnchantedEmeraldBlock(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD_BLOCK), "Enchanted Emerald Block", RarityType::UNCOMMON));
		$this->register(new EnchantedDiamond(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND), "Enchanted Diamond", RarityType::COMMON));
		$this->register(new EnchantedDiamondBlock(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND_BLOCK), "Enchanted Diamond Block", RarityType::UNCOMMON));

		$this->register(new EnchantedFlint(new CustomItemIdentifier(CustomItemIds::ENCHANTED_FLINT), "Enchanted Flint", RarityType::COMMON));
		$this->register(new EnchantedSand(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SAND), "Enchanted Sand", RarityType::COMMON));
		$this->register(new EnchantedClay(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CLAY), "Enchanted Clay", RarityType::COMMON));
		$this->register(new EnchantedSnow(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SNOW), "Enchanted Snow", RarityType::COMMON));
		$this->register(new EnchantedIce(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ICE), "Enchanted Ice", RarityType::COMMON));
		$this->register(new EnchantedPackedIce(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PACKED_ICE), "Enchanted Packed Ice", RarityType::UNCOMMON));
		$this->register(new EnchantedBlueIce(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BLUE_ICE), "Enchanted Blue Ice", RarityType::RARE));

		$this->register(new RefinedDiamond(new CustomItemIdentifier(CustomItemIds::REFINED_DIAMOND), "Refined Diamond", RarityType::RARE));
		$this->register(new NoicePaper(new CustomItemIdentifier(CustomItemIds::NOICE_PAPER), "Noice Paper", RarityType::LEGENDARY));

		$this->registerMetaLess(new MetaLessItem(new CustomItemIdentifier(CustomItemIds::LAPIS_LAZULI), new MetaLessIdentifier(ItemIds::DYE, 4)));
	}
}