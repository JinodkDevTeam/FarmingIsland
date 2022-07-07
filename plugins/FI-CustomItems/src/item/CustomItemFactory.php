<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\armor\BoosterBoots;
use CustomItems\item\armor\MagmaBoots;
use CustomItems\item\armor\SlimeBoots;
use CustomItems\item\fishingrod\AncientRod;
use CustomItems\item\fishingrod\auto\MechanicalRod;
use CustomItems\item\fishingrod\auto\OpAutomationRod;
use CustomItems\item\fishingrod\FiberglassRod;
use CustomItems\item\fishingrod\GrapplingHook;
use CustomItems\item\fishingrod\OpRod;
use CustomItems\item\fishingrod\RodOfChallenging;
use CustomItems\item\fishingrod\RodOfChampions;
use CustomItems\item\fishingrod\RodOfLegends;
use CustomItems\item\fishingrod\RodOfTheSea;
use CustomItems\item\fishingrod\StarterRod;
use CustomItems\item\utils\Rarity;
use pocketmine\block\VanillaBlocks;
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
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COBBLESTONE), "Enchanted Cobblestone", Rarity::COMMON(), VanillaBlocks::COBBLESTONE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL), "Enchanted Coal", Rarity::COMMON(), VanillaItems::COAL()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL_BLOCK), "Enchanted Coal Block", Rarity::UNCOMMON(), VanillaBlocks::COAL()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_INGOT), "Enchanted Iron Ingot", Rarity::COMMON(), VanillaItems::IRON_INGOT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_BLOCK), "Enchanted Iron Block", Rarity::UNCOMMON(), VanillaBlocks::IRON()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_INGOT), "Enchanted Gold Ingot", Rarity::COMMON(), VanillaItems::GOLD_INGOT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_BLOCK), "Enchanted Gold Block", Rarity::UNCOMMON(), VanillaBlocks::GOLD()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS), "Enchanted Lapis Lazuli", Rarity::COMMON(), VanillaItems::LAPIS_LAZULI()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS_BLOCK), "Enchanted Lapis Block", Rarity::UNCOMMON(), VanillaBlocks::LAPIS_LAZULI()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE), "Enchanted Redstone Dust", Rarity::COMMON(), VanillaItems::REDSTONE_DUST()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE_BLOCK), "Enchanted Redstone Block", Rarity::UNCOMMON(), VanillaBlocks::REDSTONE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD), "Enchanted Emerald", Rarity::COMMON(), VanillaItems::EMERALD()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD_BLOCK), "Enchanted Emerald Block", Rarity::UNCOMMON(), VanillaBlocks::EMERALD()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND), "Enchanted Diamond", Rarity::COMMON(), VanillaItems::DIAMOND()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND_BLOCK), "Enchanted Diamond Block", Rarity::UNCOMMON(), VanillaBlocks::DIAMOND()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_FLINT), "Enchanted Flint", Rarity::COMMON(), VanillaItems::FLINT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SAND), "Enchanted Sand", Rarity::COMMON(), VanillaBlocks::SAND()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CLAY), "Enchanted Clay", Rarity::COMMON(), VanillaItems::CLAY()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CLAY_BLOCK), "Enchanted Clay Block", Rarity::UNCOMMON(), VanillaBlocks::CLAY()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SNOW), "Enchanted Snow", Rarity::COMMON(), VanillaBlocks::SNOW()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ICE), "Enchanted Ice", Rarity::COMMON(), VanillaBlocks::ICE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PACKED_ICE), "Enchanted Packed Ice", Rarity::UNCOMMON(), VanillaBlocks::PACKED_ICE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BLUE_ICE), "Enchanted Blue Ice", Rarity::RARE(), VanillaBlocks::BLUE_ICE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLOWSTONE_DUST), "Enchanted Glowstone Dust", Rarity::COMMON(), VanillaItems::GLOWSTONE_DUST()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLOWSTONE), "Enchanted Glowstone", Rarity::UNCOMMON(), VanillaBlocks::GLOWSTONE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERRACK), "Enchanted Netherrack", Rarity::COMMON(), VanillaBlocks::NETHERRACK()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_QUARTZ), "Enchanted Quartz", Rarity::COMMON(), VanillaItems::NETHER_QUARTZ()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_QUARTZ_BLOCK), "Enchanted Quartz Block", Rarity::UNCOMMON(), VanillaBlocks::QUARTZ()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ENDSTONE), "Enchanted Endstone", Rarity::COMMON(), VanillaBlocks::END_STONE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_OBSIDIAN), "Enchanted Obsidian", Rarity::COMMON(), VanillaBlocks::OBSIDIAN()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SEED), "Enchanted Seed", Rarity::COMMON(), VanillaItems::WHEAT_SEEDS()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_WHEAT), "Enchanted Wheat", Rarity::COMMON(), VanillaItems::WHEAT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_HAY_BALE), "Enchanted Hay Bale", Rarity::UNCOMMON(), VanillaBlocks::HAY_BALE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CARROT), "Enchanted Carrot", Rarity::COMMON(), VanillaItems::CARROT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLDEN_CARROT), "Enchanted Golden Carrot", Rarity::UNCOMMON(), VanillaItems::GOLDEN_CARROT()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_POTATO), "Enchanted Potato", Rarity::COMMON(), VanillaItems::POTATO()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SUGAR), "Enchanted Sugar", Rarity::COMMON(), VanillaItems::SUGAR()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SUGAR_CANE), "Enchanted Sugar Cane", Rarity::COMMON(), VanillaBlocks::SUGARCANE()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_APPLE), "Enchanted Apple", Rarity::UNCOMMON(), VanillaItems::APPLE()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PUMKIN), "Enchanted Pumpkin", Rarity::COMMON(), VanillaBlocks::PUMPKIN()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_MELON), "Enchanted Melon", Rarity::COMMON(), VanillaItems::MELON()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_MELON_BLOCK), "Enchanted Melon Block", Rarity::UNCOMMON(), VanillaBlocks::MELON()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLISTERIN_MELON), "Enchanted Glisterin Melon", Rarity::UNCOMMON(), VanillaItems::GLISTERING_MELON()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CACTUS), "Enchanted Cactus", Rarity::COMMON(), VanillaBlocks::CACTUS()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERWART), "Enchanted Nether Wart", Rarity::COMMON(), VanillaBlocks::NETHER_WART()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERWART_BLOCK), "Enchanted Wart Block", Rarity::COMMON(), VanillaBlocks::NETHER_WART_BLOCK()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_OAK_WOOD), "Enchanted Oak Wood", Rarity::COMMON(), VanillaBlocks::OAK_WOOD()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BIRCH_WOOD), "Enchanted Birch Wood", Rarity::COMMON(), VanillaBlocks::BIRCH_WOOD()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SPRUCE_WOOD), "Enchanted Spruce Wood", Rarity::COMMON(), VanillaBlocks::SPRUCE_WOOD()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_JUNGLE_WOOD), "Enchanted Jungle Wood", Rarity::COMMON(), VanillaBlocks::JUNGLE_WOOD()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ACIA_WOOD), "Enchanted Acia Wood", Rarity::COMMON(), VanillaBlocks::ACACIA_WOOD()->asItem()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DARK_OAK_WOOD), "Enchanted Dark Oak Wood", Rarity::COMMON(), VanillaBlocks::DARK_OAK_WOOD()->asItem()));

		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_IRON), "Refined Iron", Rarity::RARE(), VanillaItems::LIGHT_GRAY_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_GOLD), "Refined Gold", Rarity::RARE(), VanillaItems::YELLOW_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_EMERALD), "Refined Emerald", Rarity::RARE(), VanillaItems::LIME_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_DIAMOND), "Refined Diamond", Rarity::RARE(), VanillaItems::LIGHT_BLUE_DYE()));
		$this->register(new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_TITANIUM), "Refined Titanium", Rarity::LEGENDARY(), VanillaBLocks::DIORITE()->asItem()));

		$this->register(new NoicePaper(new CustomItemIdentifier(CustomItemIds::NOICE_PAPER), "Noice Paper", Rarity::LEGENDARY()));
		$this->register(new Crook(new CustomItemIdentifier(CustomItemIds::CROOK), "Crook", Rarity::RARE()));
		$this->register(new TitaniumDrill(new CustomItemIdentifier(CustomItemIds::TITANIUM_DRILL), "Titanium Drill", Rarity::VERY_SPECIAL()));
		$this->register(new EnchantedItem(new CustomItemIdentifier(CustomItemIds::DRILL_FUEL), "Drill Fuel", Rarity::LEGENDARY(), VanillaItems::NETHER_STAR()));
		$this->register(new BackpackSlot(new CustomItemIdentifier(CustomItemIds::BACKPACK_SLOT), "Backpack Slot", Rarity::LEGENDARY()));

		$this->register(new EmeraldBlade(new CustomItemIdentifier(CustomItemIds::EMERALD_BLADE), "Emerald Blade", Rarity::EPIC()));
		$this->register(new RefinedEmeraldBlade(new CustomItemIdentifier(CustomItemIds::REFINED_EMERALD_BLADE), "Refined Emerald Blade", Rarity::LEGENDARY()));
		$this->register(new AspectOfTheEnd(new CustomItemIdentifier(CustomItemIds::ASPECT_OF_THE_END), "Aspect of the End", Rarity::RARE()));
		$this->register(new TreeCapitator(new CustomItemIdentifier(CustomItemIds::TREECAPITATOR), "Treecapitator", Rarity::EPIC()));
		$this->register(new JujuStaff(new CustomItemIdentifier(CustomItemIds::JUJU_STAFF), "Juju Staff", Rarity::LEGENDARY()));
		$this->register(new MagmaBoots(new CustomItemIdentifier(CustomItemIds::MAGMA_BOOTS), "Magma Boots", Rarity::LEGENDARY()));
		$this->register(new TreeCutter(new CustomItemIdentifier(CustomItemIds::TREECUTTER), "Tree Cutter", Rarity::LEGENDARY()));
		$this->register(new BoosterBoots(new CustomItemIdentifier(CustomItemIds::BOOSTER_BOOTS), "Booster Boots", Rarity::LEGENDARY()));
		$this->register(new SlimeBoots(new CustomItemIdentifier(CustomItemIds::SLIME_BOOTS), "Slime Boots", Rarity::LEGENDARY()));

		$this->register(new OpRod(new CustomItemIdentifier(CustomItemIds::OP_ROD), "OP Rod", Rarity::SPECIAL()));
		$this->register(new StarterRod(new CustomItemIdentifier(CustomItemIds::STARTER_ROD), "Starter Rod", Rarity::COMMON()));
		$this->register(new OpAutomationRod(new CustomItemIdentifier(CustomItemIds::OP_AUTOMATION_ROD), "OP Automation Rod", Rarity::SPECIAL()));
		$this->register(new FiberglassRod(new CustomItemIdentifier(CustomItemIds::FIBERGLASS_ROD), "Fiberglass Rod", Rarity::UNCOMMON()));
		$this->register(new RodOfChallenging(new CustomItemIdentifier(CustomItemIds::ROD_OF_CHALLENGING), "Rod Of Challenging", Rarity::UNCOMMON()));
		$this->register(new RodOfChampions(new CustomItemIdentifier(CustomItemIds::ROD_OF_CHAMPIONS), "Rod Of Champions", Rarity::RARE()));
		$this->register(new RodOfLegends(new CustomItemIdentifier(CustomItemIds::ROD_OF_LEGENDS), "Rod Of Legends", Rarity::EPIC()));
		$this->register(new RodOfTheSea(new CustomItemIdentifier(CustomItemIds::ROD_OF_THE_SEA), "Rod Of The Sea", Rarity::LEGENDARY()));
		$this->register(new MechanicalRod(new CustomItemIdentifier(CustomItemIds::MECHANICAL_ROD), "Mechanical Rod", Rarity::RARE()));
		$this->register(new AncientRod(new CustomItemIdentifier(CustomItemIds::ANCIENT_ROD), "Ancient Rod", Rarity::EPIC()));
		$this->register(new GrapplingHook(new CustomItemIdentifier(CustomItemIds::GRAPPLING_HOOK), "Grappling Hook", Rarity::UNCOMMON()));

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