<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\Rarity;
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
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COBBLESTONE), "Enchanted Cobblestone", Rarity::COMMON(), $i->get(ItemIds::COBBLESTONE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL), "Enchanted Coal", Rarity::COMMON(), VanillaItems::COAL()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL_BLOCK), "Enchanted Coal Block", Rarity::UNCOMMON(), $i->get(ItemIds::COAL_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_INGOT), "Enchanted Iron Ingot", Rarity::COMMON(), VanillaItems::IRON_INGOT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_BLOCK), "Enchanted Iron Block", Rarity::UNCOMMON(), $i->get(ItemIds::IRON_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_INGOT), "Enchanted Gold Ingot", Rarity::COMMON(), VanillaItems::GOLD_INGOT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_BLOCK), "Enchanted Gold Block", Rarity::UNCOMMON(), $i->get(ItemIds::GOLD_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS), "Enchanted Lapis Lazuli", Rarity::COMMON(), VanillaItems::LAPIS_LAZULI()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS_BLOCK), "Enchanted Lapis Block", Rarity::UNCOMMON(), $i->get(ItemIds::LAPIS_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE), "Enchanted Redstone Dust", Rarity::COMMON(), VanillaItems::REDSTONE_DUST()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE_BLOCK), "Enchanted Redstone Block", Rarity::UNCOMMON(), $i->get(ItemIds::REDSTONE_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD), "Enchanted Emerald", Rarity::COMMON(), VanillaItems::EMERALD()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD_BLOCK), "Enchanted Emerald Block", Rarity::UNCOMMON(), $i->get(ItemIds::EMERALD_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND), "Enchanted Diamond", Rarity::COMMON(), VanillaItems::DIAMOND()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND_BLOCK), "Enchanted Diamond Block", Rarity::UNCOMMON(), $i->get(ItemIds::DIAMOND_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_FLINT), "Enchanted Flint", Rarity::COMMON(), VanillaItems::FLINT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SAND), "Enchanted Sand", Rarity::COMMON(), $i->get(ItemIds::SAND)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CLAY), "Enchanted Clay", Rarity::COMMON(), VanillaItems::CLAY()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CLAY_BLOCK), "Enchanted Clay Block", Rarity::UNCOMMON(), ItemFactory::getInstance()->get(ItemIds::CLAY_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SNOW), "Enchanted Snow", Rarity::COMMON(), $i->get(ItemIds::SNOW)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ICE), "Enchanted Ice", Rarity::COMMON(), $i->get(ItemIds::ICE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PACKED_ICE), "Enchanted Packed Ice", Rarity::UNCOMMON(), $i->get(ItemIds::PACKED_ICE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BLUE_ICE), "Enchanted Blue Ice", Rarity::RARE(), $i->get(ItemIds::BLUE_ICE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLOWSTONE_DUST), "Enchanted Glowstone Dust", Rarity::COMMON(), VanillaItems::GLOWSTONE_DUST()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLOWSTONE), "Enchanted Glowstone", Rarity::UNCOMMON(), $i->get(ItemIds::GLOWSTONE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERRACK), "Enchanted Netherrack", Rarity::COMMON(), $i->get(ItemIds::NETHERRACK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_QUARTZ), "Enchanted Quartz", Rarity::COMMON(), VanillaItems::NETHER_QUARTZ()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_QUARTZ_BLOCK), "Enchanted Quartz Block", Rarity::UNCOMMON(), ItemFactory::getInstance()->get(ItemIds::QUARTZ_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ENDSTONE), "Enchanted Endstone", Rarity::COMMON(), $i->get(ItemIds::END_STONE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_OBSIDIAN), "Enchanted Obsidian", Rarity::COMMON(), $i->get(ItemIds::OBSIDIAN)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SEED), "Enchanted Seed", Rarity::COMMON(), VanillaItems::WHEAT_SEEDS()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_WHEAT), "Enchanted Wheat", Rarity::COMMON(), VanillaItems::WHEAT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_HAY_BALE), "Enchanted Hay Bale", Rarity::UNCOMMON(), $i->get(ItemIds::HAY_BALE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CARROT), "Enchanted Carrot", Rarity::COMMON(), VanillaItems::CARROT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLDEN_CARROT), "Enchanted Golden Carrot", Rarity::UNCOMMON(), VanillaItems::GOLDEN_CARROT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_POTATO), "Enchanted Potato", Rarity::COMMON(), VanillaItems::POTATO()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SUGAR), "Enchanted Sugar", Rarity::COMMON(), $i->get(ItemIds::SUGAR)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SUGAR_CANE), "Enchanted Sugar Cane", Rarity::COMMON(), $i->get(ItemIds::SUGARCANE)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_APPLE), "Enchanted Apple", Rarity::UNCOMMON(), VanillaItems::APPLE()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PUMKIN), "Enchanted Pumpkin", Rarity::COMMON(), $i->get(ItemIds::PUMPKIN)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_MELON), "Enchanted Melon", Rarity::COMMON(), VanillaItems::MELON()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_MELON_BLOCK), "Enchanted Melon Block", Rarity::UNCOMMON(), $i->get(ItemIds::MELON_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLISTERIN_MELON), "Enchanted Glisterin Melon", Rarity::UNCOMMON(), VanillaItems::GLISTERING_MELON()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CACTUS), "Enchanted Cactus", Rarity::COMMON(), $i->get(ItemIds::CACTUS)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERWART), "Enchanted Nether Wart", Rarity::COMMON(), $i->get(ItemIds::NETHER_WART)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERWART_BLOCK), "Enchanted Wart Block", Rarity::COMMON(), $i->get(ItemIds::NETHER_WART_BLOCK)));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_OAK_WOOD), "Enchanted Oak Wood", Rarity::COMMON(), $i->get(ItemIds::LOG, TreeType::OAK()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BIRCH_WOOD), "Enchanted Birch Wood", Rarity::COMMON(), $i->get(ItemIds::LOG, TreeType::BIRCH()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SPRUCE_WOOD), "Enchanted Spruce Wood", Rarity::COMMON(), $i->get(ItemIds::LOG, TreeType::SPRUCE()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_JUNGLE_WOOD), "Enchanted Jungle Wood", Rarity::COMMON(), $i->get(ItemIds::LOG, TreeType::JUNGLE()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ACIA_WOOD), "Enchanted Acia Wood", Rarity::COMMON(), $i->get(ItemIds::LOG, TreeType::ACACIA()->getMagicNumber())));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DARK_OAK_WOOD), "Enchanted Dark Oak Wood", Rarity::COMMON(), $i->get(ItemIds::LOG, TreeType::DARK_OAK()->getMagicNumber())));

		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_IRON), "Refined Iron", Rarity::RARE(), VanillaItems::LIGHT_GRAY_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_GOLD), "Refined Gold", Rarity::RARE(), VanillaItems::YELLOW_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_EMERALD), "Refined Emerald", Rarity::RARE(), VanillaItems::LIME_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_DIAMOND), "Refined Diamond", Rarity::RARE(), VanillaItems::LIGHT_BLUE_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_TITANIUM), "Refined Titanium", Rarity::LEGENDARY(), ItemFactory::getInstance()->get(ItemIds::STONE, 4)));

		$this->register(new NoicePaper(new CustomItemIdentifier(CustomItemIds::NOICE_PAPER), "Noice Paper", Rarity::LEGENDARY()));
		$this->register(new Crook(new CustomItemIdentifier(CustomItemIds::CROOK), "Crook", Rarity::RARE()));
		$this->register(new TitaniumDrill(new CustomItemIdentifier(CustomItemIds::TITANIUM_DRILL), "Titanium Drill", Rarity::VERY_SPECIAL()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::DRILL_FUEL), "Drill Fuel", Rarity::LEGENDARY(), VanillaItems::NETHER_STAR()));
		$this->register(new BackpackSlot(new CustomItemIdentifier(CustomItemIds::BACKPACK_SLOT), "Backpack Slot", Rarity::LEGENDARY()));

		$this->register(new EmeraldBlade(new CustomItemIdentifier(CustomItemIds::EMERALD_BLADE), "Emerald Blade", Rarity::EPIC()));
		$this->register(new RefinedEmeraldBlade(new CustomItemIdentifier(CustomItemIds::REFINED_EMERALD_BLADE), "Refined Emerald Blade", Rarity::LEGENDARY()));
		$this->register(new AspectOfTheEnd(new CustomItemIdentifier(CustomItemIds::ASPECT_OF_THE_END), "Aspect of the End", Rarity::RARE()));
		$this->register(new TreeCapitator(new CustomItemIdentifier(CustomItemIds::TREECAPITATOR), "Treecapitator", Rarity::EPIC()));

		$this->register(new OpRod(new CustomItemIdentifier(CustomItemIds::OP_ROD), "OP Rod", Rarity::SPECIAL()));
		$this->register(new StarterRod(new CustomItemIdentifier(CustomItemIds::STARTER_ROD), "Starter Rod", Rarity::COMMON()));
		$this->register(new OpAutomationRod(new CustomItemIdentifier(CustomItemIds::OP_AUTOMATION_ROD), "OP Automation Rod", Rarity::SPECIAL()));

		$this->register(new GameBreaker(new CustomItemIdentifier(CustomItemIds::GAME_BREAKER), "Game Breaker", Rarity::SPECIAL()));
		$this->register(new GameAnnihilator(new CustomItemIdentifier(CustomItemIds::GAME_ANNIHILATOR), "Game Annihilator", Rarity::VERY_SPECIAL()));
		$this->register(new AnnihilatorSword(new CustomItemIdentifier(CustomItemIds::ANNIHILATOR_SWORD), "Annihilator Sword", Rarity::ULTIMATE()));

		$this->registerMetaLessItems();
	}

	public function registerMetaLessItems() : void{
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

	/**
	 * @param int $id
	 *
	 * @return CustomItem|null
	 */
	public function get(int $id) : ?CustomItem{
		if(isset($this->list[$id])){
			return $this->list[$id];
		}
		return null;
	}

	/**
	 * @param MetaLessItem $item
	 * @param bool         $overwrite
	 *
	 * @throws RuntimeException
	 */
	public function registerMetaLess(MetaLessItem $item, bool $overwrite = false) : void{
		$id = $item->getMetaLessIdentifier()->getId();
		$meta = $item->getMetaLessIdentifier()->getMeta();
		if(isset($this->mlist[$id . ":" . $meta]) && (!$overwrite)){
			throw new RuntimeException("Trying to overwrite an already registered item !");
		}
		$this->list[$id . ":" . $meta] = clone $item;

		$this->register($item);
	}

	/**
	 * @param int $id
	 *
	 * @return bool
	 */
	public function isRegistered(int $id) : bool{
		if(isset($this->list[$id])){
			return true;
		}
		return false;
	}

	/**
	 * @param int $id
	 * @param int $meta
	 *
	 * @return MetaLessItem|null
	 */
	public function getMetaLessItem(int $id, int $meta) : ?MetaLessItem{
		if(isset($this->mlist[$id . ":" . $meta])){
			return $this->mlist[$id . ":" . $meta];
		}
		return null;
	}
}