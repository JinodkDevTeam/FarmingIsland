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
use InvalidArgumentException;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;
use pocketmine\utils\CloningRegistryTrait;
use CustomItems\item\CustomItemNamespaceIds as CustomItemIds;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @generate-registry-docblock
 *
 * @method static EnchantedItem ENCHANTED_COBBLESTONE()
 * @method static EnchantedItem ENCHANTED_COAL()
 * @method static EnchantedItem ENCHANTED_COAL_BLOCK()
 * @method static EnchantedItem ENCHANTED_IRON()
 * @method static EnchantedItem ENCHANTED_IRON_BLOCK()
 * @method static EnchantedItem ENCHANTED_GOLD()
 * @method static EnchantedItem ENCHANTED_GOLD_BLOCK()
 * @method static EnchantedItem ENCHANTED_LAPIS_LAZULI()
 * @method static EnchantedItem ENCHANTED_LAPIS_BLOCK()
 * @method static EnchantedItem ENCHANTED_REDSTONE()
 * @method static EnchantedItem ENCHANTED_REDSTONE_BLOCK()
 * @method static EnchantedItem ENCHANTED_EMERALD()
 * @method static EnchantedItem ENCHANTED_EMERALD_BLOCK()
 * @method static EnchantedItem ENCHANTED_DIAMOND()
 * @method static EnchantedItem ENCHANTED_DIAMOND_BLOCK()
 * @method static EnchantedItem ENCHANTED_FLINT()
 * @method static EnchantedItem ENCHANTED_SAND()
 * @method static EnchantedItem ENCHANTED_CLAY()
 * @method static EnchantedItem ENCHANTED_CLAY_BLOCK()
 * @method static EnchantedItem ENCHANTED_SNOW()
 * @method static EnchantedItem ENCHANTED_ICE()
 * @method static EnchantedItem ENCHANTED_PACKED_ICE()
 * @method static EnchantedItem ENCHANTED_BLUE_ICE()
 * @method static EnchantedItem ENCHANTED_GLOWSTONE_DUST()
 * @method static EnchantedItem ENCHANTED_GLOWSTONE()
 * @method static EnchantedItem ENCHANTED_NETHERRACK()
 * @method static EnchantedItem ENCHANTED_QUARTZ()
 * @method static EnchantedItem ENCHANTED_QUARTZ_BLOCK()
 * @method static EnchantedItem ENCHANTED_ENDSTONE()
 * @method static EnchantedItem ENCHANTED_OBSIDIAN()
 * @method static EnchantedItem ENCHANTED_SEED()
 * @method static EnchantedItem ENCHANTED_WHEAT()
 * @method static EnchantedItem ENCHANTED_HAY_BALE()
 * @method static EnchantedItem ENCHANTED_CARROT()
 * @method static EnchantedItem ENCHANTED_GOLDEN_CARROT()
 * @method static EnchantedItem ENCHANTED_POTATO()
 * @method static EnchantedItem ENCHANTED_SUGAR()
 * @method static EnchantedItem ENCHANTED_SUGAR_CANE()
 * @method static EnchantedItem ENCHANTED_APPLE()
 * @method static EnchantedItem ENCHANTED_PUMPKIN()
 * @method static EnchantedItem ENCHANTED_MELON()
 * @method static EnchantedItem ENCHANTED_MELON_BLOCK()
 * @method static EnchantedItem ENCHANTED_GLISTERIN_MELON()
 * @method static EnchantedItem ENCHANTED_CACTUS()
 * @method static EnchantedItem ENCHANTED_NETHERWART()
 * @method static EnchantedItem ENCHANTED_NETHERWART_BLOCK()
 * @method static EnchantedItem ENCHANTED_OAK_WOOD()
 * @method static EnchantedItem ENCHANTED_BIRCH_WOOD()
 * @method static EnchantedItem ENCHANTED_SPRUCE_WOOD()
 * @method static EnchantedItem ENCHANTED_JUNGLE_WOOD()
 * @method static EnchantedItem ENCHANTED_ACIA_WOOD()
 * @method static EnchantedItem ENCHANTED_DARK_OAK_WOOD()
 * @method static RefinedItem REFINED_IRON()
 * @method static RefinedItem REFINED_GOLD()
 * @method static RefinedItem REFINED_EMERALD()
 * @method static RefinedItem REFINED_DIAMOND()
 * @method static RefinedItem REFINED_TITANIUM()
 * @method static NoicePaper NOICE_PAPER()
 * @method static Crook CROOK()
 * @method static TitaniumDrill TITANIUM_DRILL()
 * @method static EnchantedItem DRILL_FUEL()
 * @method static BackpackSlot BACKPACK_SLOT()
 * @method static EmeraldBlade EMERALD_BLADE()
 * @method static RefinedEmeraldBlade REFINED_EMERALD_BLADE()
 * @method static AspectOfTheEnd ASPECT_OF_THE_END()
 * @method static TreeCapitator TREECAPITATOR()
 * @method static JujuStaff JUJU_STAFF()
 * @method static MagmaBoots MAGMA_BOOTS()
 * @method static TreeCutter TREECUTTER()
 * @method static BoosterBoots BOOSTER_BOOTS()
 * @method static SlimeBoots SLIME_BOOTS()
 * @method static OpRod OP_ROD()
 * @method static StarterRod STARTER_ROD()
 * @method static OpAutomationRod OP_AUTOMATION_ROD()
 * @method static FiberglassRod FIBERGLASS_ROD()
 * @method static RodOfChallenging ROD_OF_CHALLENGING()
 * @method static RodOfChampions ROD_OF_CHAMPIONS()
 * @method static RodOfLegends ROD_OF_LEGENDS()
 * @method static RodOfTheSea ROD_OF_THE_SEA()
 * @method static MechanicalRod MECHANICAL_ROD()
 * @method static AncientRod ANCIENT_ROD()
 * @method static GrapplingHook GRAPPLING_HOOK()
 * @method static GameBreaker GAME_BREAKER()
 * @method static GameAnnihilator GAME_ANNIHILATOR()
 * @method static AnnihilatorSword ANNIHILATOR_SWORD()
 */
class CustomItems{
	use CloningRegistryTrait;

	/** @var CustomItem[] */
	private array $list = [];
	/** @var MetaLessItem[] */
	private array $mlist = [];

	protected static function setup() : void{
		self::register("enchanted_cobblestone" , new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COBBLESTONE), "Enchanted Cobblestone", Rarity::COMMON(), VanillaBlocks::COBBLESTONE()->asItem()));
		self::register("enchanted_coal", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL), "Enchanted Coal", Rarity::COMMON(), VanillaItems::COAL()));
		self::register("enchanted_coal_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_COAL_BLOCK), "Enchanted Coal Block", Rarity::UNCOMMON(), VanillaBlocks::COAL()->asItem()));
		self::register("enchanted_iron", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON), "Enchanted Iron Ingot", Rarity::COMMON(), VanillaItems::IRON_INGOT()));
		self::register("enchanted_iron_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_IRON_BLOCK), "Enchanted Iron Block", Rarity::UNCOMMON(), VanillaBlocks::IRON()->asItem()));
		self::register("enchanted_gold", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD), "Enchanted Gold Ingot", Rarity::COMMON(), VanillaItems::GOLD_INGOT()));
		self::register("enchanted_gold_block" , new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLD_BLOCK), "Enchanted Gold Block", Rarity::UNCOMMON(), VanillaBlocks::GOLD()->asItem()));
		self::register("enchanted_lapis_lazuli", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS_LAZULI), "Enchanted Lapis Lazuli", Rarity::COMMON(), VanillaItems::LAPIS_LAZULI()));
		self::register("enchanted_lapis_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_LAPIS_BLOCK), "Enchanted Lapis Block", Rarity::UNCOMMON(), VanillaBlocks::LAPIS_LAZULI()->asItem()));
		self::register("enchanted_redstone", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE), "Enchanted Redstone Dust", Rarity::COMMON(), VanillaItems::REDSTONE_DUST()));
		self::register("enchanted_redstone_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_REDSTONE_BLOCK), "Enchanted Redstone Block", Rarity::UNCOMMON(), VanillaBlocks::REDSTONE()->asItem()));
		self::register("enchanted_emerald", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD), "Enchanted Emerald", Rarity::COMMON(), VanillaItems::EMERALD()));
		self::register("enchanted_emerald_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_EMERALD_BLOCK), "Enchanted Emerald Block", Rarity::UNCOMMON(), VanillaBlocks::EMERALD()->asItem()));
		self::register("enchanted_diamond", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND), "Enchanted Diamond", Rarity::COMMON(), VanillaItems::DIAMOND()));
		self::register("enchanted_diamond_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DIAMOND_BLOCK), "Enchanted Diamond Block", Rarity::UNCOMMON(), VanillaBlocks::DIAMOND()->asItem()));
		self::register("enchanted_flint", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_FLINT), "Enchanted Flint", Rarity::COMMON(), VanillaItems::FLINT()));
		self::register("enchanted_sand", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SAND), "Enchanted Sand", Rarity::COMMON(), VanillaBlocks::SAND()->asItem()));
		self::register("enchanted_clay",new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CLAY), "Enchanted Clay", Rarity::COMMON(), VanillaItems::CLAY()));
		self::register("enchanted_clay_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CLAY_BLOCK), "Enchanted Clay Block", Rarity::UNCOMMON(), VanillaBlocks::CLAY()->asItem()));
		self::register("enchanted_snow",new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SNOW), "Enchanted Snow", Rarity::COMMON(), VanillaBlocks::SNOW()->asItem()));
		self::register("enchanted_ice", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ICE), "Enchanted Ice", Rarity::COMMON(), VanillaBlocks::ICE()->asItem()));
		self::register("enchanted_packed_ice",new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PACKED_ICE), "Enchanted Packed Ice", Rarity::UNCOMMON(), VanillaBlocks::PACKED_ICE()->asItem()));
		self::register("enchanted_blue_ice", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BLUE_ICE), "Enchanted Blue Ice", Rarity::RARE(), VanillaBlocks::BLUE_ICE()->asItem()));
		self::register("enchanted_glowstone_dust", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLOWSTONE_DUST), "Enchanted Glowstone Dust", Rarity::COMMON(), VanillaItems::GLOWSTONE_DUST()));
		self::register("enchanted_glowstone", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLOWSTONE), "Enchanted Glowstone", Rarity::UNCOMMON(), VanillaBlocks::GLOWSTONE()->asItem()));
		self::register("enchanted_netherrack", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERRACK), "Enchanted Netherrack", Rarity::COMMON(), VanillaBlocks::NETHERRACK()->asItem()));
		self::register("enchanted_quartz", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_QUARTZ), "Enchanted Quartz", Rarity::COMMON(), VanillaItems::NETHER_QUARTZ()));
		self::register("enchanted_quartz_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_QUARTZ_BLOCK), "Enchanted Quartz Block", Rarity::UNCOMMON(), VanillaBlocks::QUARTZ()->asItem()));
		self::register("enchanted_endstone", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ENDSTONE), "Enchanted Endstone", Rarity::COMMON(), VanillaBlocks::END_STONE()->asItem()));
		self::register("enchanted_obsidian", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_OBSIDIAN), "Enchanted Obsidian", Rarity::COMMON(), VanillaBlocks::OBSIDIAN()->asItem()));
		self::register("enchanted_seed", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SEED), "Enchanted Seed", Rarity::COMMON(), VanillaItems::WHEAT_SEEDS()));
		self::register("enchanted_wheat", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_WHEAT), "Enchanted Wheat", Rarity::COMMON(), VanillaItems::WHEAT()));
		self::register("enchanted_hay_bale", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_HAY_BALE), "Enchanted Hay Bale", Rarity::UNCOMMON(), VanillaBlocks::HAY_BALE()->asItem()));
		self::register("enchanted_carrot", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CARROT), "Enchanted Carrot", Rarity::COMMON(), VanillaItems::CARROT()));
		self::register("enchanted_golden_carrot", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GOLDEN_CARROT), "Enchanted Golden Carrot", Rarity::UNCOMMON(), VanillaItems::GOLDEN_CARROT()));
		self::register("enchanted_potato", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_POTATO), "Enchanted Potato", Rarity::COMMON(), VanillaItems::POTATO()));
		self::register("enchanted_sugar", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SUGAR), "Enchanted Sugar", Rarity::COMMON(), VanillaItems::SUGAR()));
		self::register("enchanted_sugar_cane", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SUGAR_CANE), "Enchanted Sugar Cane", Rarity::COMMON(), VanillaBlocks::SUGARCANE()->asItem()));
		self::register("enchanted_apple", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_APPLE), "Enchanted Apple", Rarity::UNCOMMON(), VanillaItems::APPLE()));
		self::register("enchanted_pumpkin", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_PUMPKIN), "Enchanted Pumpkin", Rarity::COMMON(), VanillaBlocks::PUMPKIN()->asItem()));
		self::register("enchanted_melon", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_MELON), "Enchanted Melon", Rarity::COMMON(), VanillaItems::MELON()));
		self::register("enchanted_melon_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_MELON_BLOCK), "Enchanted Melon Block", Rarity::UNCOMMON(), VanillaBlocks::MELON()->asItem()));
		self::register("enchanted_glisterin_melon", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_GLISTERIN_MELON), "Enchanted Glisterin Melon", Rarity::UNCOMMON(), VanillaItems::GLISTERING_MELON()));
		self::register("enchanted_cactus", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_CACTUS), "Enchanted Cactus", Rarity::COMMON(), VanillaBlocks::CACTUS()->asItem()));
		self::register("enchanted_netherwart", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERWART), "Enchanted Nether Wart", Rarity::COMMON(), VanillaBlocks::NETHER_WART()->asItem()));
		self::register("enchanted_netherwart_block", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_NETHERWART_BLOCK), "Enchanted Wart Block", Rarity::COMMON(), VanillaBlocks::NETHER_WART_BLOCK()->asItem()));
		self::register("enchanted_oak_wood", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_OAK_WOOD), "Enchanted Oak Wood", Rarity::COMMON(), VanillaBlocks::OAK_WOOD()->asItem()));
		self::register("enchanted_birch_wood", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_BIRCH_WOOD), "Enchanted Birch Wood", Rarity::COMMON(), VanillaBlocks::BIRCH_WOOD()->asItem()));
		self::register("enchanted_spruce_wood", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_SPRUCE_WOOD), "Enchanted Spruce Wood", Rarity::COMMON(), VanillaBlocks::SPRUCE_WOOD()->asItem()));
		self::register("enchanted_jungle_wood", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_JUNGLE_WOOD), "Enchanted Jungle Wood", Rarity::COMMON(), VanillaBlocks::JUNGLE_WOOD()->asItem()));
		self::register("enchanted_acia_wood", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_ACIA_WOOD), "Enchanted Acia Wood", Rarity::COMMON(), VanillaBlocks::ACACIA_WOOD()->asItem()));
		self::register("enchanted_dark_oak_wood", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::ENCHANTED_DARK_OAK_WOOD), "Enchanted Dark Oak Wood", Rarity::COMMON(), VanillaBlocks::DARK_OAK_WOOD()->asItem()));
		self::register("refined_iron", new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_IRON), "Refined Iron", Rarity::RARE(), VanillaItems::LIGHT_GRAY_DYE()));
		self::register("refined_gold", new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_GOLD), "Refined Gold", Rarity::RARE(), VanillaItems::YELLOW_DYE()));
		self::register("refined_emerald", new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_EMERALD), "Refined Emerald", Rarity::RARE(), VanillaItems::LIME_DYE()));
		self::register("refined_diamond", new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_DIAMOND), "Refined Diamond", Rarity::RARE(), VanillaItems::LIGHT_BLUE_DYE()));
		self::register("refined_titanium", new RefinedItem(new CustomItemIdentifier(CustomItemIds::REFINED_TITANIUM), "Refined Titanium", Rarity::LEGENDARY(), VanillaBLocks::DIORITE()->asItem()));
		self::register("noice_paper", new NoicePaper(new CustomItemIdentifier(CustomItemIds::NOICE_PAPER), "Noice Paper", Rarity::LEGENDARY()));
		self::register("crook", new Crook(new CustomItemIdentifier(CustomItemIds::CROOK), "Crook", Rarity::RARE()));
		self::register("titanium_drill", new TitaniumDrill(new CustomItemIdentifier(CustomItemIds::TITANIUM_DRILL), "Titanium Drill", Rarity::VERY_SPECIAL()));
		self::register("drill_fuel", new EnchantedItem(new CustomItemIdentifier(CustomItemIds::DRILL_FUEL), "Drill Fuel", Rarity::LEGENDARY(), VanillaItems::NETHER_STAR()));
		self::register("backpack_slot", new BackpackSlot(new CustomItemIdentifier(CustomItemIds::BACKPACK_SLOT), "Backpack Slot", Rarity::LEGENDARY()));
		self::register("emerald_blade", new EmeraldBlade(new CustomItemIdentifier(CustomItemIds::EMERALD_BLADE), "Emerald Blade", Rarity::EPIC()));
		self::register("refined_emerald_blade", new RefinedEmeraldBlade(new CustomItemIdentifier(CustomItemIds::REFINED_EMERALD_BLADE), "Refined Emerald Blade", Rarity::LEGENDARY()));
		self::register("aspect_of_the_end", new AspectOfTheEnd(new CustomItemIdentifier(CustomItemIds::ASPECT_OF_THE_END), "Aspect of the End", Rarity::RARE()));
		self::register("treecapitator", new TreeCapitator(new CustomItemIdentifier(CustomItemIds::TREECAPITATOR), "Treecapitator", Rarity::EPIC()));
		self::register("juju_staff", new JujuStaff(new CustomItemIdentifier(CustomItemIds::JUJU_STAFF), "Juju Staff", Rarity::LEGENDARY()));
		self::register("magma_boots", new MagmaBoots(new CustomItemIdentifier(CustomItemIds::MAGMA_BOOTS), "Magma Boots", Rarity::LEGENDARY()));
		self::register("treecutter", new TreeCutter(new CustomItemIdentifier(CustomItemIds::TREECUTTER), "Tree Cutter", Rarity::LEGENDARY()));
		self::register("booster_boots", new BoosterBoots(new CustomItemIdentifier(CustomItemIds::BOOSTER_BOOTS), "Booster Boots", Rarity::LEGENDARY()));
		self::register("slime_boots", new SlimeBoots(new CustomItemIdentifier(CustomItemIds::SLIME_BOOTS), "Slime Boots", Rarity::LEGENDARY()));
		self::register("op_rod", new OpRod(new CustomItemIdentifier(CustomItemIds::OP_ROD), "OP Rod", Rarity::SPECIAL()));
		self::register("starter_rod", new StarterRod(new CustomItemIdentifier(CustomItemIds::STARTER_ROD), "Starter Rod", Rarity::COMMON()));
		self::register("op_automation_rod", new OpAutomationRod(new CustomItemIdentifier(CustomItemIds::OP_AUTOMATION_ROD), "OP Automation Rod", Rarity::SPECIAL()));
		self::register("fiberglass_rod", new FiberglassRod(new CustomItemIdentifier(CustomItemIds::FIBERGLASS_ROD), "Fiberglass Rod", Rarity::UNCOMMON()));
		self::register("rod_of_challenging", new RodOfChallenging(new CustomItemIdentifier(CustomItemIds::ROD_OF_CHALLENGING), "Rod Of Challenging", Rarity::UNCOMMON()));
		self::register("rod_of_champions", new RodOfChampions(new CustomItemIdentifier(CustomItemIds::ROD_OF_CHAMPIONS), "Rod Of Champions", Rarity::RARE()));
		self::register("rod_of_legends", new RodOfLegends(new CustomItemIdentifier(CustomItemIds::ROD_OF_LEGENDS), "Rod Of Legends", Rarity::EPIC()));
		self::register("rod_of_the_sea", new RodOfTheSea(new CustomItemIdentifier(CustomItemIds::ROD_OF_THE_SEA), "Rod Of The Sea", Rarity::LEGENDARY()));
		self::register("mechanical_rod", new MechanicalRod(new CustomItemIdentifier(CustomItemIds::MECHANICAL_ROD), "Mechanical Rod", Rarity::RARE()));
		self::register("ancient_rod", new AncientRod(new CustomItemIdentifier(CustomItemIds::ANCIENT_ROD), "Ancient Rod", Rarity::EPIC()));
		self::register("grappling_hook",new GrapplingHook(new CustomItemIdentifier(CustomItemIds::GRAPPLING_HOOK), "Grappling Hook", Rarity::UNCOMMON()));
		self::register("game_breaker", new GameBreaker(new CustomItemIdentifier(CustomItemIds::GAME_BREAKER), "Game Breaker", Rarity::SPECIAL()));
		self::register("game_annihilator", new GameAnnihilator(new CustomItemIdentifier(CustomItemIds::GAME_ANNIHILATOR), "Game Annihilator", Rarity::VERY_SPECIAL()));
		self::register("annihilator_sword", new AnnihilatorSword(new CustomItemIdentifier(CustomItemIds::ANNIHILATOR_SWORD), "Annihilator Sword", Rarity::ULTIMATE()));

		self::register("lapis_lazuli", new MetaLessItem(new CustomItemIdentifier(CustomItemIds::LAPIS_LAZULI), VanillaItems::LAPIS_LAZULI())); //deprecated since pm5
	}

	protected static function register(string $name, CustomItem $item) : void{
		self::_registryRegister($name, $item);
	}

	/**
	 * @return CustomItem[]
	 */
	public static function getAll() : array{
		self::checkInit();
		/** @var CustomItem[] $result */
		$result = self::$members;
		return $result;
	}

	public static function get(string $name): ?CustomItem{
		try{
			/** @var CustomItem $result */
			$result = self::_registryFromString($name);
			return $result;
		} catch(InvalidArgumentException){
			return null;
		}
	}
}