<?php
declare(strict_types=1);

namespace CustomItems\customies;

use customiesdevs\customies\item\CustomiesItemFactory;
use CustomItems\customies\fish\CustomFish;
use pocketmine\item\Item;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @generate-registry-docblock
 *
 * @method static CustomFish ALBACORE()
 * @method static CustomFish ANCHOVY()
 * @method static CustomFish BLOBFISH()
 * @method static CustomFish BLUE_DISCUS()
 * @method static CustomFish BREAM()
 * @method static CustomFish BULLHEAD()
 * @method static CustomFish CARP()
 * @method static CustomFish CATFISH()
 * @method static CustomFish CHUB()
 * @method static CustomFish DORADO()
 * @method static CustomFish EEL()
 * @method static CustomFish FLOUNDER()
 * @method static CustomFish GHOSTFISH()
 * @method static CustomFish HALIBUT()
 * @method static CustomFish HERRING()
 * @method static CustomFish ICE_PIP()
 * @method static CustomFish LARGEMOUTH_BASS()
 * @method static CustomFish LAVA_EEL()
 * @method static CustomFish LINGCOD()
 * @method static CustomFish LIONFISH()
 * @method static CustomFish MIDNIGHT_CARP()
 * @method static CustomFish MIDNIGHT_SQUID()
 * @method static CustomFish MUTANT_CARP()
 * @method static CustomFish OCTOPUS()
 * @method static CustomFish PERCH()
 * @method static CustomFish PIKE()
 * @method static CustomFish RADIOACTIVE_CARP()
 * @method static CustomFish RAINBOW_TROUT()
 * @method static CustomFish RED_MULLET()
 * @method static CustomFish RED_SNAPPER()
 * @method static CustomFish SANDFISH()
 * @method static CustomFish SCORPION_CARP()
 * @method static CustomFish SEA_CUCUMBER()
 * @method static CustomFish SHAD()
 * @method static CustomFish SHARDINE()
 * @method static CustomFish SLIMEJACK()
 * @method static CustomFish SMALLMOUTH_BASS()
 * @method static CustomFish SPOOK_FISH()
 * @method static CustomFish SQUID()
 * @method static CustomFish STINGRAY()
 * @method static CustomFish STONEFISH()
 * @method static CustomFish STURGEON()
 * @method static CustomFish SUNFISH()
 * @method static CustomFish SUPER_CUCUMBER()
 * @method static CustomFish TIGER_TROUT()
 * @method static CustomFish TILAPIA()
 * @method static CustomFish TUNA()
 * @method static CustomFish VOID_SALMON()
 * @method static CustomFish WALLEYE()
 * @method static CustomFish WOODSKIP()
 */
class CustomiesItems{
	use CloningRegistryTrait;

	protected static function register(string $name, Item $item) : void{
		self::_registryRegister($name, $item);
	}

	/**
	 * @return Item[]
	 */
	public static function getAll() : array{
		/** @var Item[] $result */
		$result = self::_registryGetAll();
		return $result;
	}

	protected static function setup() : void{
		$factory = CustomiesItemFactory::getInstance();

		self::register("albacore", $factory->get("fi-fish:albacore"));
		self::register("anchovy", $factory->get("fi-fish:anchovy"));
		self::register("blobfish", $factory->get("fi-fish:blobfish"));
		self::register("blue_discus", $factory->get("fi-fish:blue_discus"));
		self::register("bream", $factory->get("fi-fish:bream"));
		self::register("bullhead", $factory->get("fi-fish:bullhead"));
		self::register("carp", $factory->get("fi-fish:carp"));
		self::register("catfish", $factory->get("fi-fish:catfish"));
		self::register("chub", $factory->get("fi-fish:chub"));
		self::register("dorado", $factory->get("fi-fish:dorado"));
		self::register("eel", $factory->get("fi-fish:eel"));
		self::register("flounder", $factory->get("fi-fish:flounder"));
		self::register("ghostfish", $factory->get("fi-fish:ghostfish"));
		self::register("halibut", $factory->get("fi-fish:halibut"));
		self::register("herring", $factory->get("fi-fish:herring"));
		self::register("ice_pip", $factory->get("fi-fish:ice_pip"));
		self::register("largemouth_bass", $factory->get("fi-fish:largemouth_bass"));
		self::register("lava_eel", $factory->get("fi-fish:lava_eel"));
		self::register("lingcod", $factory->get("fi-fish:lingcod"));
		self::register("lionfish", $factory->get("fi-fish:lionfish"));
		self::register("midnight_carp", $factory->get("fi-fish:midnight_carp"));
		self::register("midnight_squid", $factory->get("fi-fish:midnight_squid"));
		self::register("mutant_carp", $factory->get("fi-fish:mutant_carp"));
		self::register("octopus", $factory->get("fi-fish:octopus"));
		self::register("perch", $factory->get("fi-fish:perch"));
		self::register("pike", $factory->get("fi-fish:pike"));
		self::register("radioactive_carp", $factory->get("fi-fish:radioactive_carp"));
		self::register("rainbow_trout", $factory->get("fi-fish:rainbow_trout"));
		self::register("red_mullet", $factory->get("fi-fish:red_mullet"));
		self::register("red_snapper", $factory->get("fi-fish:red_snapper"));
		self::register("sandfish", $factory->get("fi-fish:sandfish"));
		self::register("scorpion_carp", $factory->get("fi-fish:scorpion_carp"));
		self::register("sea_cucumber", $factory->get("fi-fish:sea_cucumber"));
		self::register("shad", $factory->get("fi-fish:shad"));
		self::register("shardine", $factory->get("fi-fish:shardine"));
		self::register("slimejack", $factory->get("fi-fish:slimejack"));
		self::register("smallmouth_bass", $factory->get("fi-fish:smallmouth_bass"));
		self::register("spook_fish", $factory->get("fi-fish:spook_fish"));
		self::register("squid", $factory->get("fi-fish:squid"));
		self::register("stingray", $factory->get("fi-fish:stingray"));
		self::register("stonefish", $factory->get("fi-fish:stonefish"));
		self::register("sturgeon", $factory->get("fi-fish:sturgeon"));
		self::register("sunfish", $factory->get("fi-fish:sunfish"));
		self::register("super_cucumber", $factory->get("fi-fish:super_cucumber"));
		self::register("tiger_trout", $factory->get("fi-fish:tiger_trout"));
		self::register("tilapia", $factory->get("fi-fish:tilapia"));
		self::register("tuna", $factory->get("fi-fish:tuna"));
		self::register("void_salmon", $factory->get("fi-fish:void_salmon"));
		self::register("walleye", $factory->get("fi-fish:walleye"));
		self::register("woodskip", $factory->get("fi-fish:woodskip"));
	}
}