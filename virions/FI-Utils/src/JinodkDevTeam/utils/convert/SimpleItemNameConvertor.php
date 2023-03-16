<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils\convert;

use pocketmine\block\Block;
use pocketmine\block\Concrete;
use pocketmine\block\ConcretePowder;
use pocketmine\block\GlazedTerracotta;
use pocketmine\block\HardenedClay;
use pocketmine\block\StainedHardenedClay;
use pocketmine\block\utils\CoralType;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Wool;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class SimpleItemNameConvertor{
	protected static array $members = [];
	protected static array $items = [];

	protected static function map(Item $item, string $name) : void{
		self::$members[$item->getId() . ":" . $item->getMeta()] = $name;
		self::$items[$name] = $item;
		//Will replace with Runtime ID in PM5
	}

	protected static function mapBlock(Block $block, string $name) : void{
		$item = $block->asItem();
		self::$members[$item->getId() . ":" . $item->getMeta()] = $name;
		self::$items[$name] = $item;
		//Will replace with Runtime ID in PM5
	}

	/**
	 * @param Wool|Concrete|ConcretePowder|StainedHardenedClay $block
	 * @param string                                           $name
	 *
	 * @return void
	 */
	protected static function mapColorBlock(Wool|Concrete|ConcretePowder|StainedHardenedClay $block, string $name) : void{
		foreach(DyeColor::getAll() as $color){
			$block->setColor($color);
			DyeColor::LIGHT_GRAY();
			$color_name = strtolower($color->getDisplayName());
			if($color_name == "light gray"){
				$color_name = "silver"; //FUCK MOJANG
			}elseif($color_name == "light blue"){
				$color_name = "light_blue";
			}
			self::mapBlock($block, $name . "_" . $color_name);
		}
		//Will replace with Runtime ID in PM5
	}

	protected static function init() : void{
		//VanillaItems
		self::map(VanillaItems::EXPERIENCE_BOTTLE(), "experience_bottle");
		self::map(VanillaItems::TOTEM(), "totem");
		self::map(VanillaItems::DRAGON_BREATH(), "dragon_breath");
		self::map(VanillaItems::WRITABLE_BOOK(), "writable_book");
		self::map(VanillaItems::RABBIT_FOOT(), "rabbit_foot");
		//VanillaBlocks
		self::mapBlock(VanillaBlocks::CHISELED_QUARTZ(), "chiseled_quartz");
		self::mapBlock(VanillaBlocks::FIRE(), "fire");
		self::mapBlock(VanillaBlocks::INFO_UPDATE(), "info_update");
		self::mapBlock(VanillaBlocks::INFO_UPDATE2(), "info_update2");
		self::mapBlock(VanillaBlocks::SMOOTH_QUARTZ(), "smooth_quartz");
		self::mapBlock(VanillaBlocks::MAGMA(), "magma");
		self::mapBlock(VanillaBlocks::LIT_PUMPKIN(), "lit_pumpkin");
		//Education Edition
		self::map(VanillaItems::CHEMICAL_ALUMINIUM_OXIDE(), "chemical_aluminium_oxide");
		self::map(VanillaItems::CHEMICAL_AMMONIA(), "chemical_ammonia");
		self::map(VanillaItems::CHEMICAL_BARIUM_SULPHATE(), "chemical_barium_sulphate");
		self::map(VanillaItems::CHEMICAL_BENZENE(), "chemical_benzene");
		self::map(VanillaItems::CHEMICAL_BORON_TRIOXIDE(), "chemical_boron_trioxide");
		self::map(VanillaItems::CHEMICAL_CALCIUM_BROMIDE(), "chemical_calcium_bromide");
		self::map(VanillaItems::CHEMICAL_CALCIUM_CHLORIDE(), "chemical_calcium_chloride");
		self::map(VanillaItems::CHEMICAL_CERIUM_CHLORIDE(), "chemical_cerium_chloride");
		self::map(VanillaItems::CHEMICAL_CHARCOAL(), "chemical_charcoal");
		self::map(VanillaItems::CHEMICAL_CRUDE_OIL(), "chemical_crude_oil");
		self::map(VanillaItems::CHEMICAL_GLUE(), "chemical_glue");
		self::map(VanillaItems::CHEMICAL_HYDROGEN_PEROXIDE(), "chemical_hydrogen_peroxide");
		self::map(VanillaItems::CHEMICAL_HYPOCHLORITE(), "chemical_hypochlorite");
		self::map(VanillaItems::CHEMICAL_INK(), "chemical_ink");
		self::map(VanillaItems::CHEMICAL_IRON_SULPHIDE(), "chemical_iron_sulphide");
		self::map(VanillaItems::CHEMICAL_LATEX(), "chemical_latex");
		self::map(VanillaItems::CHEMICAL_LITHIUM_HYDRIDE(), "chemical_lithium_hydride");
		self::map(VanillaItems::CHEMICAL_LUMINOL(), "chemical_luminol");
		self::map(VanillaItems::CHEMICAL_MAGNESIUM_NITRATE(), "chemical_magnesium_nitrate");
		self::map(VanillaItems::CHEMICAL_MAGNESIUM_OXIDE(), "chemical_magnesium_oxide");
		self::map(VanillaItems::CHEMICAL_MAGNESIUM_SALTS(), "chemical_magnesium_salts");
		self::map(VanillaItems::CHEMICAL_MERCURIC_CHLORIDE(), "chemical_mercuric_chloride");
		self::map(VanillaItems::CHEMICAL_POLYETHYLENE(), "chemical_polyethylene");
		self::map(VanillaItems::CHEMICAL_POTASSIUM_CHLORIDE(), "chemical_potassium_chloride");
		self::map(VanillaItems::CHEMICAL_POTASSIUM_IODIDE(), "chemical_potassium_iodide");
		self::map(VanillaItems::CHEMICAL_RUBBISH(), "chemical_rubbish");
		self::map(VanillaItems::CHEMICAL_SALT(), "chemical_salt");
		self::map(VanillaItems::CHEMICAL_SOAP(), "chemical_soap");
		self::map(VanillaItems::CHEMICAL_SODIUM_ACETATE(), "chemical_sodium_acetate");
		self::map(VanillaItems::CHEMICAL_SODIUM_FLUORIDE(), "chemical_sodium_fluoride");
		self::map(VanillaItems::CHEMICAL_SODIUM_HYDRIDE(), "chemical_sodium_hydride");
		self::map(VanillaItems::CHEMICAL_SODIUM_HYDROXIDE(), "chemical_sodium_hydroxide");
		self::map(VanillaItems::CHEMICAL_SODIUM_HYPOCHLORITE(), "chemical_sodium_hypochlorite");
		self::map(VanillaItems::CHEMICAL_SODIUM_OXIDE(), "chemical_sodium_oxide");
		self::map(VanillaItems::CHEMICAL_SUGAR(), "chemical_sugar");
		self::map(VanillaItems::CHEMICAL_SULPHATE(), "chemical_sulphate");
		self::map(VanillaItems::CHEMICAL_TUNGSTEN_CHLORIDE(), "chemical_tungsten_chloride");
		self::map(VanillaItems::CHEMICAL_WATER(), "chemical_water");
		//Education Edition blocks
		self::mapBlock(VanillaBlocks::CHEMICAL_HEAT(), "chemical_heat");
		self::mapBlock(VanillaBlocks::ELEMENT_ACTINIUM(), "element_actinium");
		self::mapBlock(VanillaBlocks::ELEMENT_ALUMINUM(), "element_aluminum");
		self::mapBlock(VanillaBlocks::ELEMENT_AMERICIUM(), "element_americium");
		self::mapBlock(VanillaBlocks::ELEMENT_ANTIMONY(), "element_antimony");
		self::mapBlock(VanillaBlocks::ELEMENT_ARGON(), "element_argon");
		self::mapBlock(VanillaBlocks::ELEMENT_ARSENIC(), "element_arsenic");
		self::mapBlock(VanillaBlocks::ELEMENT_ASTATINE(), "element_astatine");
		self::mapBlock(VanillaBlocks::ELEMENT_BARIUM(), "element_barium");
		self::mapBlock(VanillaBlocks::ELEMENT_BERKELIUM(), "element_berkelium");
		self::mapBlock(VanillaBlocks::ELEMENT_BERYLLIUM(), "element_beryllium");
		self::mapBlock(VanillaBlocks::ELEMENT_BISMUTH(), "element_bismuth");
		self::mapBlock(VanillaBlocks::ELEMENT_BOHRIUM(), "element_bohrium");
		self::mapBlock(VanillaBlocks::ELEMENT_BORON(), "element_boron");
		self::mapBlock(VanillaBlocks::ELEMENT_BROMINE(), "element_bromine");
		self::mapBlock(VanillaBlocks::ELEMENT_CADMIUM(), "element_cadmium");
		self::mapBlock(VanillaBlocks::ELEMENT_CALCIUM(), "element_calcium");
		self::mapBlock(VanillaBlocks::ELEMENT_CALIFORNIUM(), "element_californium");
		self::mapBlock(VanillaBlocks::ELEMENT_CARBON(), "element_carbon");
		self::mapBlock(VanillaBlocks::ELEMENT_CERIUM(), "element_cerium");
		self::mapBlock(VanillaBlocks::ELEMENT_CESIUM(), "element_cesium");
		self::mapBlock(VanillaBlocks::ELEMENT_CHLORINE(), "element_chlorine");
		self::mapBlock(VanillaBlocks::ELEMENT_CHROMIUM(), "element_chromium");
		self::mapBlock(VanillaBlocks::ELEMENT_COBALT(), "element_cobalt");
		self::mapBlock(VanillaBlocks::ELEMENT_COPERNICIUM(), "element_copernicium");
		self::mapBlock(VanillaBlocks::ELEMENT_COPPER(), "element_copper");
		self::mapBlock(VanillaBlocks::ELEMENT_CURIUM(), "element_curium");
		self::mapBlock(VanillaBlocks::ELEMENT_DARMSTADTIUM(), "element_darmstadtium");
		self::mapBlock(VanillaBlocks::ELEMENT_DUBNIUM(), "element_dubnium");
		self::mapBlock(VanillaBlocks::ELEMENT_DYSPROSIUM(), "element_dysprosium");
		self::mapBlock(VanillaBlocks::ELEMENT_EINSTEINIUM(), "element_einsteinium");
		self::mapBlock(VanillaBlocks::ELEMENT_ERBIUM(), "element_erbium");
		self::mapBlock(VanillaBlocks::ELEMENT_EUROPIUM(), "element_europium");
		self::mapBlock(VanillaBlocks::ELEMENT_FERMIUM(), "element_fermium");
		self::mapBlock(VanillaBlocks::ELEMENT_FLEROVIUM(), "element_flerovium");
		self::mapBlock(VanillaBlocks::ELEMENT_FLUORINE(), "element_fluorine");
		self::mapBlock(VanillaBlocks::ELEMENT_FRANCIUM(), "element_francium");
		self::mapBlock(VanillaBlocks::ELEMENT_GADOLINIUM(), "element_gadolinium");
		self::mapBlock(VanillaBlocks::ELEMENT_GALLIUM(), "element_gallium");
		self::mapBlock(VanillaBlocks::ELEMENT_GERMANIUM(), "element_germanium");
		self::mapBlock(VanillaBlocks::ELEMENT_GOLD(), "element_gold");
		self::mapBlock(VanillaBlocks::ELEMENT_HAFNIUM(), "element_hafnium");
		self::mapBlock(VanillaBlocks::ELEMENT_HASSIUM(), "element_hassium");
		self::mapBlock(VanillaBlocks::ELEMENT_HELIUM(), "element_helium");
		self::mapBlock(VanillaBlocks::ELEMENT_HOLMIUM(), "element_holmium");
		self::mapBlock(VanillaBlocks::ELEMENT_HYDROGEN(), "element_hydrogen");
		self::mapBlock(VanillaBlocks::ELEMENT_INDIUM(), "element_indium");
		self::mapBlock(VanillaBlocks::ELEMENT_IODINE(), "element_iodine");
		self::mapBlock(VanillaBlocks::ELEMENT_IRIDIUM(), "element_iridium");
		self::mapBlock(VanillaBlocks::ELEMENT_IRON(), "element_iron");
		self::mapBlock(VanillaBlocks::ELEMENT_KRYPTON(), "element_krypton");
		self::mapBlock(VanillaBlocks::ELEMENT_LANTHANUM(), "element_lanthanum");
		self::mapBlock(VanillaBlocks::ELEMENT_LAWRENCIUM(), "element_lawrencium");
		self::mapBlock(VanillaBlocks::ELEMENT_LEAD(), "element_lead");
		self::mapBlock(VanillaBlocks::ELEMENT_LITHIUM(), "element_lithium");
		self::mapBlock(VanillaBlocks::ELEMENT_LIVERMORIUM(), "element_livermorium");
		self::mapBlock(VanillaBlocks::ELEMENT_LUTETIUM(), "element_lutetium");
		self::mapBlock(VanillaBlocks::ELEMENT_MAGNESIUM(), "element_magnesium");
		self::mapBlock(VanillaBlocks::ELEMENT_MANGANESE(), "element_manganese");
		self::mapBlock(VanillaBlocks::ELEMENT_MEITNERIUM(), "element_meitnerium");
		self::mapBlock(VanillaBlocks::ELEMENT_MENDELEVIUM(), "element_mendelevium");
		self::mapBlock(VanillaBlocks::ELEMENT_MERCURY(), "element_mercury");
		self::mapBlock(VanillaBlocks::ELEMENT_MOLYBDENUM(), "element_molybdenum");
		self::mapBlock(VanillaBlocks::ELEMENT_MOSCOVIUM(), "element_moscovium");
		self::mapBlock(VanillaBlocks::ELEMENT_NEODYMIUM(), "element_neodymium");
		self::mapBlock(VanillaBlocks::ELEMENT_NEON(), "element_neon");
		self::mapBlock(VanillaBlocks::ELEMENT_NEPTUNIUM(), "element_neptunium");
		self::mapBlock(VanillaBlocks::ELEMENT_NICKEL(), "element_nickel");
		self::mapBlock(VanillaBlocks::ELEMENT_NIHONIUM(), "element_nihonium");
		self::mapBlock(VanillaBlocks::ELEMENT_NIOBIUM(), "element_niobium");
		self::mapBlock(VanillaBlocks::ELEMENT_NITROGEN(), "element_nitrogen");
		self::mapBlock(VanillaBlocks::ELEMENT_NOBELIUM(), "element_nobelium");
		self::mapBlock(VanillaBlocks::ELEMENT_OGANESSON(), "element_oganesson");
		self::mapBlock(VanillaBlocks::ELEMENT_OSMIUM(), "element_osmium");
		self::mapBlock(VanillaBlocks::ELEMENT_OXYGEN(), "element_oxygen");
		self::mapBlock(VanillaBlocks::ELEMENT_PALLADIUM(), "element_palladium");
		self::mapBlock(VanillaBlocks::ELEMENT_PHOSPHORUS(), "element_phosphorus");
		self::mapBlock(VanillaBlocks::ELEMENT_PLATINUM(), "element_platinum");
		self::mapBlock(VanillaBlocks::ELEMENT_PLUTONIUM(), "element_plutonium");
		self::mapBlock(VanillaBlocks::ELEMENT_POLONIUM(), "element_polonium");
		self::mapBlock(VanillaBlocks::ELEMENT_POTASSIUM(), "element_potassium");
		self::mapBlock(VanillaBlocks::ELEMENT_PRASEODYMIUM(), "element_praseodymium");
		self::mapBlock(VanillaBlocks::ELEMENT_PROMETHIUM(), "element_promethium");
		self::mapBlock(VanillaBlocks::ELEMENT_PROTACTINIUM(), "element_protactinium");
		self::mapBlock(VanillaBlocks::ELEMENT_RADIUM(), "element_radium");
		self::mapBlock(VanillaBlocks::ELEMENT_RADON(), "element_radon");
		self::mapBlock(VanillaBlocks::ELEMENT_RHENIUM(), "element_rhenium");
		self::mapBlock(VanillaBlocks::ELEMENT_RHODIUM(), "element_rhodium");
		self::mapBlock(VanillaBlocks::ELEMENT_ROENTGENIUM(), "element_roentgenium");
		self::mapBlock(VanillaBlocks::ELEMENT_RUBIDIUM(), "element_rubidium");
		self::mapBlock(VanillaBlocks::ELEMENT_RUTHENIUM(), "element_ruthenium");
		self::mapBlock(VanillaBlocks::ELEMENT_RUTHERFORDIUM(), "element_rutherfordium");
		self::mapBlock(VanillaBlocks::ELEMENT_SAMARIUM(), "element_samarium");
		self::mapBlock(VanillaBlocks::ELEMENT_SCANDIUM(), "element_scandium");
		self::mapBlock(VanillaBlocks::ELEMENT_SEABORGIUM(), "element_seaborgium");
		self::mapBlock(VanillaBlocks::ELEMENT_SELENIUM(), "element_selenium");
		self::mapBlock(VanillaBlocks::ELEMENT_SILICON(), "element_silicon");
		self::mapBlock(VanillaBlocks::ELEMENT_SILVER(), "element_silver");
		self::mapBlock(VanillaBlocks::ELEMENT_SODIUM(), "element_sodium");
		self::mapBlock(VanillaBlocks::ELEMENT_STRONTIUM(), "element_strontium");
		self::mapBlock(VanillaBlocks::ELEMENT_SULFUR(), "element_sulfur");
		self::mapBlock(VanillaBlocks::ELEMENT_TANTALUM(), "element_tantalum");
		self::mapBlock(VanillaBlocks::ELEMENT_TECHNETIUM(), "element_technetium");
		self::mapBlock(VanillaBlocks::ELEMENT_TELLURIUM(), "element_tellurium");
		self::mapBlock(VanillaBlocks::ELEMENT_TENNESSINE(), "element_tennessine");
		self::mapBlock(VanillaBlocks::ELEMENT_TERBIUM(), "element_terbium");
		self::mapBlock(VanillaBlocks::ELEMENT_THALLIUM(), "element_thallium");
		self::mapBlock(VanillaBlocks::ELEMENT_THORIUM(), "element_thorium");
		self::mapBlock(VanillaBlocks::ELEMENT_THULIUM(), "element_thulium");
		self::mapBlock(VanillaBlocks::ELEMENT_TIN(), "element_tin");
		self::mapBlock(VanillaBlocks::ELEMENT_TITANIUM(), "element_titanium");
		self::mapBlock(VanillaBlocks::ELEMENT_TUNGSTEN(), "element_tungsten");
		self::mapBlock(VanillaBlocks::ELEMENT_URANIUM(), "element_uranium");
		self::mapBlock(VanillaBlocks::ELEMENT_VANADIUM(), "element_vanadium");
		self::mapBlock(VanillaBlocks::ELEMENT_XENON(), "element_xenon");
		self::mapBlock(VanillaBlocks::ELEMENT_YTTERBIUM(), "element_ytterbium");
		self::mapBlock(VanillaBlocks::ELEMENT_YTTRIUM(), "element_yttrium");
		self::mapBlock(VanillaBlocks::ELEMENT_ZERO(), "element_zero");
		self::mapBlock(VanillaBlocks::ELEMENT_ZINC(), "element_zinc");
		self::mapBlock(VanillaBlocks::ELEMENT_ZIRCONIUM(), "element_zirconium");

		//Textures names
		self::mapBlock(VanillaBlocks::MOSSY_COBBLESTONE(), "cobblestone_mossy");
		self::mapBlock(VanillaBlocks::CORAL_BLOCK()->setCoralType(CoralType::TUBE()), "coral_blue");
		self::mapBlock(VanillaBlocks::CORAL_BLOCK()->setCoralType(CoralType::BRAIN()), "coral_pink");
		self::mapBlock(VanillaBlocks::CORAL_BLOCK()->setCoralType(CoralType::BUBBLE()), "coral_purple");
		self::mapBlock(VanillaBlocks::CORAL_BLOCK()->setCoralType(CoralType::FIRE()), "coral_red");
		self::mapBlock(VanillaBlocks::CORAL_BLOCK()->setCoralType(CoralType::HORN()), "coral_yellow");
		self::mapBlock(VanillaBlocks::ACACIA_LOG(), "log_acacia");
		self::mapBlock(VanillaBlocks::DARK_OAK_LOG(), "log_big_oak");
		self::mapBlock(VanillaBlocks::BIRCH_LOG(), "log_birch");
		self::mapBlock(VanillaBlocks::JUNGLE_LOG(), "log_jungle");
		self::mapBlock(VanillaBlocks::OAK_LOG(), "log_oak");
		self::mapBlock(VanillaBlocks::SPRUCE_LOG(), "log_spruce");
		self::mapBlock(VanillaBlocks::NETHER_BRICKS(), "nether_brick");
		self::mapBlock(VanillaBlocks::ACACIA_PLANKS(), "planks_acacia");
		self::mapBlock(VanillaBlocks::DARK_OAK_PLANKS(), "planks_big_oak");
		self::mapBlock(VanillaBlocks::BIRCH_PLANKS(), "planks_birch");
		self::mapBlock(VanillaBlocks::JUNGLE_PLANKS(), "planks_jungle");
		self::mapBlock(VanillaBlocks::OAK_PLANKS(), "planks_oak");
		self::mapBlock(VanillaBlocks::SPRUCE_PLANKS(), "planks_spruce");
		self::mapBlock(VanillaBlocks::DARK_PRISMARINE(), "prismarine_dark");
		self::mapBlock(VanillaBlocks::ANDESITE(), "stone_andesite");
		self::mapBlock(VanillaBlocks::POLISHED_ANDESITE(), "stone_andesite_smooth");
		self::mapBlock(VanillaBlocks::DIORITE(), "stone_diorite");
		self::mapBlock(VanillaBlocks::POLISHED_DIORITE(), "stone_diorite_smooth");
		self::mapBlock(VanillaBlocks::GRANITE(), "stone_granite");
		self::mapBlock(VanillaBlocks::POLISHED_GRANITE(), "stone_granite_smooth");

		self::mapBlock(VanillaBlocks::BLACK_GLAZED_TERRACOTTA(), "glazed_terracotta_black");
		self::mapBlock(VanillaBlocks::BLUE_GLAZED_TERRACOTTA(), "glazed_terracotta_blue");
		self::mapBlock(VanillaBlocks::BROWN_GLAZED_TERRACOTTA(), "glazed_terracotta_brown");
		self::mapBlock(VanillaBlocks::CYAN_GLAZED_TERRACOTTA(), "glazed_terracotta_cyan");
		self::mapBlock(VanillaBlocks::GRAY_GLAZED_TERRACOTTA(), "glazed_terracotta_gray");
		self::mapBlock(VanillaBlocks::GREEN_GLAZED_TERRACOTTA(), "glazed_terracotta_green");
		self::mapBlock(VanillaBlocks::LIGHT_BLUE_GLAZED_TERRACOTTA(), "glazed_terracotta_light_blue");
		self::mapBlock(VanillaBlocks::LIME_GLAZED_TERRACOTTA(), "glazed_terracotta_lime");
		self::mapBlock(VanillaBlocks::MAGENTA_GLAZED_TERRACOTTA(), "glazed_terracotta_magenta");
		self::mapBlock(VanillaBlocks::ORANGE_GLAZED_TERRACOTTA(), "glazed_terracotta_orange");
		self::mapBlock(VanillaBlocks::PINK_GLAZED_TERRACOTTA(), "glazed_terracotta_pink");
		self::mapBlock(VanillaBlocks::PURPLE_GLAZED_TERRACOTTA(), "glazed_terracotta_purple");
		self::mapBlock(VanillaBlocks::RED_GLAZED_TERRACOTTA(), "glazed_terracotta_red");
		self::mapBlock(VanillaBlocks::LIGHT_GRAY_GLAZED_TERRACOTTA(), "glazed_terracotta_silver");
		self::mapBlock(VanillaBlocks::WHITE_GLAZED_TERRACOTTA(), "glazed_terracotta_white");
		self::mapBlock(VanillaBlocks::YELLOW_GLAZED_TERRACOTTA(), "glazed_terracotta_yellow");

		self::mapColorBlock(VanillaBlocks::CONCRETE(), "concrete");
		self::mapColorBlock(VanillaBlocks::CONCRETE_POWDER(), "concrete_powder");
		self::mapColorBlock(VanillaBlocks::WOOL(), "wool_colored");
		self::mapColorBlock(VanillaBlocks::STAINED_CLAY(), "hardened_clay_stained");
	}

	protected static function checkInit() : void{
		if((!isset(self::$members)) or (self::$members == [])){
			self::init();
		}
	}

	public static function convert(Item $item) : ?string{
		self::checkInit();
		if(isset(self::$members[$item->getId() . ":" . $item->getMeta()])){
			return self::$members[$item->getId() . ":" . $item->getMeta()];
		}
		return null;
	}

	public static function fromString(string $name) : ?Item{
		self::checkInit();
		if(isset(self::$items[$name])){
			return self::$items[$name];
		}
		return null;
	}
}