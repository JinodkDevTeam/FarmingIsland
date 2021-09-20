<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\block\utils\TreeType;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\utils\SingletonTrait;
use RuntimeException;

class CustomItemFactory{
	use SingletonTrait;

	/** @var CustomItem[] */
	private array $list = [];
	/** @var MetaLessItem[] */
	private array $mlist = [];

	public function __construct(){
		$i = ItemFactory::getInstance();
		//Register custom items
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COBBLESTONE), "Enchanted Cobblestone", RarityType::COMMON, $i->get(ItemIds::COBBLESTONE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL), "Enchanted Coal", RarityType::COMMON, VanillaItems::COAL()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL_BLOCK), "Enchanted Coal Block", RarityType::UNCOMMON, $i->get(ItemIds::COAL_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_INGOT), "Enchanted Iron Ingot", RarityType::COMMON, VanillaItems::IRON_INGOT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_BLOCK), "Enchanted Iron Block", RarityType::UNCOMMON, $i->get(ItemIds::IRON_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_INGOT), "Enchanted Gold Ingot", RarityType::COMMON, VanillaItems::GOLD_INGOT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_BLOCK), "Enchanted Gold Block", RarityType::UNCOMMON, $i->get(ItemIds::GOLD_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS), "Enchanted Lapis Lazuli", RarityType::COMMON, VanillaItems::LAPIS_LAZULI()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS_BLOCK), "Enchanted Lapis Block", RarityType::UNCOMMON, $i->get(ItemIds::LAPIS_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE), "Enchanted Redstone Dust", RarityType::COMMON, VanillaItems::REDSTONE_DUST()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE_BLOCK), "Enchanted Redstone Block", RarityType::UNCOMMON, $i->get(ItemIds::REDSTONE_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD), "Enchanted Emerald", RarityType::COMMON, VanillaItems::EMERALD()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD_BLOCK), "Enchanted Emerald Block", RarityType::UNCOMMON, $i->get(ItemIds::EMERALD_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND), "Enchanted Diamond", RarityType::COMMON, VanillaItems::DIAMOND()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND_BLOCK), "Enchanted Diamond Block", RarityType::UNCOMMON, $i->get(ItemIds::DIAMOND_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_FLINT), "Enchanted Flint", RarityType::COMMON, VanillaItems::FLINT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SAND), "Enchanted Sand", RarityType::COMMON, $i->get(ItemIds::SAND)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CLAY), "Enchanted Clay", RarityType::COMMON, VanillaItems::CLAY()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SNOW), "Enchanted Snow", RarityType::COMMON, $i->get(ItemIds::SNOW)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ICE), "Enchanted Ice", RarityType::COMMON, $i->get(ItemIds::ICE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PACKED_ICE), "Enchanted Packed Ice", RarityType::UNCOMMON, $i->get(ItemIds::PACKED_ICE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BLUE_ICE), "Enchanted Blue Ice", RarityType::RARE, $i->get(ItemIds::BLUE_ICE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLOWSTONE_DUST), "Enchanted Glowstone Dust", RarityType::COMMON, VanillaItems::GLOWSTONE_DUST()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLOWSTONE), "Enchanted Glowstone", RarityType::UNCOMMON, $i->get(ItemIds::GLOWSTONE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERRACK), "Enchanted Netherrack", RarityType::COMMON, $i->get(ItemIds::NETHERRACK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ENDSTONE), "Enchanted Endstone", RarityType::COMMON, $i->get(ItemIds::END_STONE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_OBSIDIAN), "Enchanted Obsidian", RarityType::COMMON, $i->get(ItemIds::OBSIDIAN)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SEED), "Enchanted Seed", RarityType::COMMON, VanillaItems::WHEAT_SEEDS()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_WHEAT), "Enchanted Wheat", RarityType::COMMON, VanillaItems::WHEAT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_HAY_BALE), "Enchanted Hay Bale", RarityType::UNCOMMON, $i->get(ItemIds::HAY_BALE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CARROT), "Enchanted Carrot", RarityType::COMMON, VanillaItems::CARROT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLDEN_CARROT), "Enchanted Golden Carrot", RarityType::UNCOMMON, VanillaItems::GOLDEN_CARROT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_POTATO), "Enchanted Potato", RarityType::COMMON, VanillaItems::POTATO()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SUGAR), "Enchanted Sugar", RarityType::COMMON, $i->get(ItemIds::SUGAR)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SUGAR_CANE), "Enchanted Sugar Cane", RarityType::COMMON, $i->get(ItemIds::SUGARCANE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_APPLE), "Enchanted Apple", RarityType::UNCOMMON, VanillaItems::APPLE()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PUMKIN), "Enchanted Pumpkin", RarityType::COMMON, $i->get(ItemIds::PUMPKIN)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_MELON), "Enchanted Melon", RarityType::COMMON, VanillaItems::MELON()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_MELON_BLOCK), "Enchanted Melon Block", RarityType::UNCOMMON, $i->get(ItemIds::MELON_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLISTERIN_MELON), "Enchanted Glisterin Melon", RarityType::UNCOMMON, VanillaItems::GLISTERING_MELON()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CACTUS), "Enchanted Cactus", RarityType::COMMON, $i->get(ItemIds::CACTUS)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERWART), "Enchanted Nether Wart", RarityType::COMMON, $i->get(ItemIds::NETHER_WART)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERWART_BLOCK), "Enchanted Wart Block", RarityType::COMMON, $i->get(ItemIds::NETHER_WART_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_OAK_WOOD), "Enchanted Oak Wood", RarityType::COMMON, $i->get(ItemIds::LOG, TreeType::OAK()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BIRCH_WOOD), "Enchanted Birch Wood", RarityType::COMMON, $i->get(ItemIds::LOG, TreeType::BIRCH()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SPRUCE_WOOD), "Enchanted Spruce Wood", RarityType::COMMON, $i->get(ItemIds::LOG, TreeType::SPRUCE()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_JUNGLE_WOOD), "Enchanted Jungle Wood", RarityType::COMMON, $i->get(ItemIds::LOG, TreeType::JUNGLE()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ACIA_WOOD), "Enchanted Acia Wood", RarityType::COMMON, $i->get(ItemIds::LOG, TreeType::ACACIA()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DARK_OAK_WOOD), "Enchanted Dark Oak Wood", RarityType::COMMON, $i->get(ItemIds::LOG, TreeType::DARK_OAK()->getMagicNumber())));

		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_IRON), "Refined Iron", RarityType::RARE, VanillaItems::LIGHT_GRAY_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_GOLD), "Refined Gold", RarityType::RARE, VanillaItems::YELLOW_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_EMERALD), "Refined Emerald", RarityType::RARE, VanillaItems::LIME_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_DIAMOND), "Refined Diamond", RarityType::RARE, VanillaItems::LIGHT_BLUE_DYE()));

		$this->register(new NoicePaper(new CustomItemIdentifier(CustomItemIds::NOICE_PAPER), "Noice Paper", RarityType::LEGENDARY));
		$this->register(new TitaniumDrill(new CustomItemIdentifier(CustomItemIds::TITANIUM_DRILL), "Titanium Drill", RarityType::VERY_SPECIAL));

		$this->registerMetaLess(new MetaLessItem(new CustomItemIdentifier(CustomItemIds::LAPIS_LAZULI), new MetaLessIdentifier(ItemIds::DYE, 4)));
	}

	/**
	 * @param CustomItem $item
	 * @param bool       $overwrite
	 *
	 * @throws RuntimeException
	 */
	public function register(CustomItem $item, bool $overwrite = false) : void{
		$id = $item->getId();
		if(isset($this->list[$id]) && (!$overwrite)){
			throw new RuntimeException("Trying to overwrite an already registered item !");
		}
		$this->list[$id] = clone $item;
	}

	public function get(int $id) : ?CustomItem{
		if(isset($this->list[$id])){
			return $this->list[$id];
		}
		return null;
	}

	public function registerMetaLess(MetaLessItem $item, bool $overwrite = false) : void{
		$id = $item->getMetaLessIdentifier()->getId();
		$meta = $item->getMetaLessIdentifier()->getMeta();
		if(isset($this->mlist[$id . ":" . $meta]) && (!$overwrite)){
			throw new RuntimeException("Trying to overwrite an already registered item !");
		}
		$this->list[$id . ":" . $meta] = clone $item;

		$this->register($item);
	}

	public function isRegistered(int $id) : bool{
		if(isset($this->list[$id])){
			return true;
		}
		return false;
	}

	public function getMetaLessItem(int $id, int $meta) : ?MetaLessItem{
		if(isset($this->mlist[$id . ":" . $meta])){
			return $this->mlist[$id . ":" . $meta];
		}
		return null;
	}
}