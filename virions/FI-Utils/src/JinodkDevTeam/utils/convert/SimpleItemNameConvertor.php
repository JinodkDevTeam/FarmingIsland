<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils\convert;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class SimpleItemNameConvertor{
	protected static array $members = [];

	protected static function map(Item $item, string $name) : void{
		self::$members[$item->getId() . ":" . $item->getMeta()] = $name;
		//Will replace with Runtime ID in PM5
	}

	protected static function init() : void{
		self::map(VanillaItems::EXPERIENCE_BOTTLE(), "experience_bottle");
		self::map(VanillaItems::TOTEM(), "totem");
		self::map(VanillaItems::DRAGON_BREATH(), "dragon_breath");
		self::map(VanillaItems::WRITABLE_BOOK(), "writable_book");
		self::map(VanillaItems::RABBIT_FOOT(), "rabbit_foot");
		//Education Edition stuffs
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
	}

	protected static function checkInit() : void{
		if((!isset(self::$members)) or (self::$members == [])){
			self::init();
		}
	}

	public static function convert(Item $item) : ?string{
		self::checkInit();
		if (isset(self::$members[$item->getId() . ":" . $item->getMeta()])){
			return self::$members[$item->getId() . ":" . $item->getMeta()];
		}
		return null;
	}
}