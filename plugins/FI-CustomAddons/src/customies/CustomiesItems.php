<?php
declare(strict_types=1);

namespace CustomAddons\customies;

use CustomAddons\customies\minesweeper\FlagItem;
use CustomAddons\customies\weapons\sword\Sword;
use customiesdevs\customies\item\CustomiesItemFactory;
use CustomAddons\customies\drill\Drill;
use CustomAddons\customies\fish\CustomFish;
use CustomAddons\customies\icon\CustomIcon;
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
 * @method static CustomIcon GOLDEN_GIFT()
 * @method static CustomIcon GREEN_GIFT()
 * @method static CustomIcon NO()
 * @method static CustomIcon NONE()
 * @method static CustomIcon RED_GIFT()
 * @method static CustomIcon YES()
 * @method static Drill IRON_DRILL()
 * @method static Drill GOLDEN_DRILL()
 * @method static Drill DIAMOND_DRILL()
 * @method static Drill MEGA_DRILL()
 * @method static Sword ASPECT_OF_THE_END()
 * @method static Sword GIANT_SWORD
 * @method static Sword HYPERION()
 * @method static Sword LUNABY_LIGHTSTICK
 *
 * @method static FlagItem ITEM_FLAG()
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

		self::register("albacore", $factory->get("fici:albacore"));
		self::register("anchovy", $factory->get("fici:anchovy"));
		self::register("blobfish", $factory->get("fici:blobfish"));
		self::register("blue_discus", $factory->get("fici:blue_discus"));
		self::register("bream", $factory->get("fici:bream"));
		self::register("bullhead", $factory->get("fici:bullhead"));
		self::register("carp", $factory->get("fici:carp"));
		self::register("catfish", $factory->get("fici:catfish"));
		self::register("chub", $factory->get("fici:chub"));
		self::register("dorado", $factory->get("fici:dorado"));
		self::register("eel", $factory->get("fici:eel"));
		self::register("flounder", $factory->get("fici:flounder"));
		self::register("ghostfish", $factory->get("fici:ghostfish"));
		self::register("halibut", $factory->get("fici:halibut"));
		self::register("herring", $factory->get("fici:herring"));
		self::register("ice_pip", $factory->get("fici:ice_pip"));
		self::register("largemouth_bass", $factory->get("fici:largemouth_bass"));
		self::register("lava_eel", $factory->get("fici:lava_eel"));
		self::register("lingcod", $factory->get("fici:lingcod"));
		self::register("lionfish", $factory->get("fici:lionfish"));
		self::register("midnight_carp", $factory->get("fici:midnight_carp"));
		self::register("midnight_squid", $factory->get("fici:midnight_squid"));
		self::register("mutant_carp", $factory->get("fici:mutant_carp"));
		self::register("octopus", $factory->get("fici:octopus"));
		self::register("perch", $factory->get("fici:perch"));
		self::register("pike", $factory->get("fici:pike"));
		self::register("radioactive_carp", $factory->get("fici:radioactive_carp"));
		self::register("rainbow_trout", $factory->get("fici:rainbow_trout"));
		self::register("red_mullet", $factory->get("fici:red_mullet"));
		self::register("red_snapper", $factory->get("fici:red_snapper"));
		self::register("sandfish", $factory->get("fici:sandfish"));
		self::register("scorpion_carp", $factory->get("fici:scorpion_carp"));
		self::register("sea_cucumber", $factory->get("fici:sea_cucumber"));
		self::register("shad", $factory->get("fici:shad"));
		self::register("shardine", $factory->get("fici:shardine"));
		self::register("slimejack", $factory->get("fici:slimejack"));
		self::register("smallmouth_bass", $factory->get("fici:smallmouth_bass"));
		self::register("spook_fish", $factory->get("fici:spook_fish"));
		self::register("squid", $factory->get("fici:squid"));
		self::register("stingray", $factory->get("fici:stingray"));
		self::register("stonefish", $factory->get("fici:stonefish"));
		self::register("sturgeon", $factory->get("fici:sturgeon"));
		self::register("sunfish", $factory->get("fici:sunfish"));
		self::register("super_cucumber", $factory->get("fici:super_cucumber"));
		self::register("tiger_trout", $factory->get("fici:tiger_trout"));
		self::register("tilapia", $factory->get("fici:tilapia"));
		self::register("tuna", $factory->get("fici:tuna"));
		self::register("void_salmon", $factory->get("fici:void_salmon"));
		self::register("walleye", $factory->get("fici:walleye"));
		self::register("woodskip", $factory->get("fici:woodskip"));
		self::register("golden_gift", $factory->get("fici:golden_gift"));
		self::register("green_gift", $factory->get("fici:green_gift"));
		self::register("no", $factory->get("fici:no"));
		self::register("none", $factory->get("fici:none"));
		self::register("red_gift", $factory->get("fici:red_gift"));
		self::register("yes", $factory->get("fici:yes"));
		self::register("iron_drill", $factory->get("fici:iron_drill"));
		self::register("golden_drill", $factory->get("fici:golden_drill"));
		self::register("diamond_drill", $factory->get("fici:diamond_drill"));
		self::register("mega_drill", $factory->get("fici:mega_drill"));
		self::register("aspect_of_the_end", $factory->get("fici:aspect_of_the_end"));
		self::register("giant_sword", $factory->get("fici:giant_sword"));
		self::register("hyperion", $factory->get("fici:hyperion"));
		self::register("lunaby_lightstick", $factory->get("fici:lunaby_lightstick"));

		self::register("item_flag", $factory->get("ms:item_flag"));
	}
}