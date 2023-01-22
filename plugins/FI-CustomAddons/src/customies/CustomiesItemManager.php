<?php
declare(strict_types=1);

namespace CustomAddons\customies;

use CustomAddons\customies\weapons\sword\AspectOfTheEnd;
use CustomAddons\customies\weapons\sword\GiantSword;
use CustomAddons\customies\weapons\sword\Hyperion;
use CustomAddons\customies\weapons\sword\LunabyLightstick;
use customiesdevs\customies\item\CustomiesItemFactory;
use CustomAddons\customies\drill\DiamondDrill;
use CustomAddons\customies\drill\GoldenDrill;
use CustomAddons\customies\drill\IronDrill;
use CustomAddons\customies\drill\MegaDrill;
use CustomAddons\customies\fish\Albacore;
use CustomAddons\customies\fish\Anchovy;
use CustomAddons\customies\fish\Blobfish;
use CustomAddons\customies\fish\BlueDiscus;
use CustomAddons\customies\fish\Bream;
use CustomAddons\customies\fish\Bullhead;
use CustomAddons\customies\fish\Carp;
use CustomAddons\customies\fish\Catfish;
use CustomAddons\customies\fish\Chub;
use CustomAddons\customies\fish\Dorado;
use CustomAddons\customies\fish\Eel;
use CustomAddons\customies\fish\Flounder;
use CustomAddons\customies\fish\Ghostfish;
use CustomAddons\customies\fish\Halibut;
use CustomAddons\customies\fish\Herring;
use CustomAddons\customies\fish\IcePip;
use CustomAddons\customies\fish\LargemouthBass;
use CustomAddons\customies\fish\LavaEel;
use CustomAddons\customies\fish\Lingcod;
use CustomAddons\customies\fish\Lionfish;
use CustomAddons\customies\fish\MidnightCarp;
use CustomAddons\customies\fish\MidnightSquid;
use CustomAddons\customies\fish\MutantCarp;
use CustomAddons\customies\fish\Octopus;
use CustomAddons\customies\fish\Perch;
use CustomAddons\customies\fish\Pike;
use CustomAddons\customies\fish\RadioactiveCarp;
use CustomAddons\customies\fish\RainbowTrout;
use CustomAddons\customies\fish\RedMullet;
use CustomAddons\customies\fish\RedSnapper;
use CustomAddons\customies\fish\Sandfish;
use CustomAddons\customies\fish\ScorpionCarp;
use CustomAddons\customies\fish\SeaCucumber;
use CustomAddons\customies\fish\Shad;
use CustomAddons\customies\fish\Shardine;
use CustomAddons\customies\fish\Slimejack;
use CustomAddons\customies\fish\SmallmouthBass;
use CustomAddons\customies\fish\SpookFish;
use CustomAddons\customies\fish\Squid;
use CustomAddons\customies\fish\Stingray;
use CustomAddons\customies\fish\Stonefish;
use CustomAddons\customies\fish\Sturgeon;
use CustomAddons\customies\fish\Sunfish;
use CustomAddons\customies\fish\SuperCucumber;
use CustomAddons\customies\fish\TigerTrout;
use CustomAddons\customies\fish\Tilapia;
use CustomAddons\customies\fish\Tuna;
use CustomAddons\customies\fish\VoidSalmon;
use CustomAddons\customies\fish\Walleye;
use CustomAddons\customies\fish\Woodskip;
use CustomAddons\customies\icon\GoldenGift;
use CustomAddons\customies\icon\GreenGift;
use CustomAddons\customies\icon\No;
use CustomAddons\customies\icon\None;
use CustomAddons\customies\icon\RedGift;
use CustomAddons\customies\icon\Yes;

class CustomiesItemManager{
	public static function register() : void{
		//Auto generated by NgLamMakeTools
		CustomiesItemFactory::getInstance()->registerItem(Albacore::class, "fici:albacore", "Albacore");
		CustomiesItemFactory::getInstance()->registerItem(Anchovy::class, "fici:anchovy", "Anchovy");
		CustomiesItemFactory::getInstance()->registerItem(Blobfish::class, "fici:blobfish", "Blobfish");
		CustomiesItemFactory::getInstance()->registerItem(BlueDiscus::class, "fici:blue_discus", "Blue Discus");
		CustomiesItemFactory::getInstance()->registerItem(Bream::class, "fici:bream", "Bream");
		CustomiesItemFactory::getInstance()->registerItem(Bullhead::class, "fici:bullhead", "Bullhead");
		CustomiesItemFactory::getInstance()->registerItem(Carp::class, "fici:carp", "Carp");
		CustomiesItemFactory::getInstance()->registerItem(Catfish::class, "fici:catfish", "Catfish");
		CustomiesItemFactory::getInstance()->registerItem(Chub::class, "fici:chub", "Chub");
		CustomiesItemFactory::getInstance()->registerItem(Dorado::class, "fici:dorado", "Dorado");
		CustomiesItemFactory::getInstance()->registerItem(Eel::class, "fici:eel", "Eel");
		CustomiesItemFactory::getInstance()->registerItem(Flounder::class, "fici:flounder", "Flounder");
		CustomiesItemFactory::getInstance()->registerItem(Ghostfish::class, "fici:ghostfish", "Ghostfish");
		CustomiesItemFactory::getInstance()->registerItem(Halibut::class, "fici:halibut", "Halibut");
		CustomiesItemFactory::getInstance()->registerItem(Herring::class, "fici:herring", "Herring");
		CustomiesItemFactory::getInstance()->registerItem(IcePip::class, "fici:ice_pip", "Ice Pip");
		CustomiesItemFactory::getInstance()->registerItem(LargemouthBass::class, "fici:largemouth_bass", "Largemouth Bass");
		CustomiesItemFactory::getInstance()->registerItem(LavaEel::class, "fici:lava_eel", "Lava Eel");
		CustomiesItemFactory::getInstance()->registerItem(Lingcod::class, "fici:lingcod", "Lingcod");
		CustomiesItemFactory::getInstance()->registerItem(Lionfish::class, "fici:lionfish", "Lionfish");
		CustomiesItemFactory::getInstance()->registerItem(MidnightCarp::class, "fici:midnight_carp", "Midnight Carp");
		CustomiesItemFactory::getInstance()->registerItem(MidnightSquid::class, "fici:midnight_squid", "Midnight Squid");
		CustomiesItemFactory::getInstance()->registerItem(MutantCarp::class, "fici:mutant_carp", "Mutant Carp");
		CustomiesItemFactory::getInstance()->registerItem(Octopus::class, "fici:octopus", "Octopus");
		CustomiesItemFactory::getInstance()->registerItem(Perch::class, "fici:perch", "Perch");
		CustomiesItemFactory::getInstance()->registerItem(Pike::class, "fici:pike", "Pike");
		CustomiesItemFactory::getInstance()->registerItem(RadioactiveCarp::class, "fici:radioactive_carp", "Radioactive Carp");
		CustomiesItemFactory::getInstance()->registerItem(RainbowTrout::class, "fici:rainbow_trout", "Rainbow Trout");
		CustomiesItemFactory::getInstance()->registerItem(RedMullet::class, "fici:red_mullet", "Red Mullet");
		CustomiesItemFactory::getInstance()->registerItem(RedSnapper::class, "fici:red_snapper", "Red Snapper");
		CustomiesItemFactory::getInstance()->registerItem(Sandfish::class, "fici:sandfish", "Sandfish");
		CustomiesItemFactory::getInstance()->registerItem(ScorpionCarp::class, "fici:scorpion_carp", "Scorpion Carp");
		CustomiesItemFactory::getInstance()->registerItem(SeaCucumber::class, "fici:sea_cucumber", "Sea Cucumber");
		CustomiesItemFactory::getInstance()->registerItem(Shad::class, "fici:shad", "Shad");
		CustomiesItemFactory::getInstance()->registerItem(Shardine::class, "fici:shardine", "Shardine");
		CustomiesItemFactory::getInstance()->registerItem(Slimejack::class, "fici:slimejack", "Slimejack");
		CustomiesItemFactory::getInstance()->registerItem(SmallmouthBass::class, "fici:smallmouth_bass", "Smallmouth Bass");
		CustomiesItemFactory::getInstance()->registerItem(SpookFish::class, "fici:spook_fish", "Spook Fish");
		CustomiesItemFactory::getInstance()->registerItem(Squid::class, "fici:squid", "Squid");
		CustomiesItemFactory::getInstance()->registerItem(Stingray::class, "fici:stingray", "Stingray");
		CustomiesItemFactory::getInstance()->registerItem(Stonefish::class, "fici:stonefish", "Stonefish");
		CustomiesItemFactory::getInstance()->registerItem(Sturgeon::class, "fici:sturgeon", "Sturgeon");
		CustomiesItemFactory::getInstance()->registerItem(Sunfish::class, "fici:sunfish", "Sunfish");
		CustomiesItemFactory::getInstance()->registerItem(SuperCucumber::class, "fici:super_cucumber", "Super Cucumber");
		CustomiesItemFactory::getInstance()->registerItem(TigerTrout::class, "fici:tiger_trout", "Tiger Trout");
		CustomiesItemFactory::getInstance()->registerItem(Tilapia::class, "fici:tilapia", "Tilapia");
		CustomiesItemFactory::getInstance()->registerItem(Tuna::class, "fici:tuna", "Tuna");
		CustomiesItemFactory::getInstance()->registerItem(VoidSalmon::class, "fici:void_salmon", "Void Salmon");
		CustomiesItemFactory::getInstance()->registerItem(Walleye::class, "fici:walleye", "Walleye");
		CustomiesItemFactory::getInstance()->registerItem(Woodskip::class, "fici:woodskip", "Woodskip");
		CustomiesItemFactory::getInstance()->registerItem(GoldenGift::class, "fici:golden_gift", "Golden Gift");
		CustomiesItemFactory::getInstance()->registerItem(GreenGift::class, "fici:green_gift", "Green Gift");
		CustomiesItemFactory::getInstance()->registerItem(No::class, "fici:no", "No");
		CustomiesItemFactory::getInstance()->registerItem(None::class, "fici:none", "None");
		CustomiesItemFactory::getInstance()->registerItem(RedGift::class, "fici:red_gift", "Red Gift");
		CustomiesItemFactory::getInstance()->registerItem(Yes::class, "fici:yes", "Yes");
		CustomiesItemFactory::getInstance()->registerItem(IronDrill::class, "fici:iron_drill", "Iron Drill");
		CustomiesItemFactory::getInstance()->registerItem(GoldenDrill::class, "fici:golden_drill", "Golden Drill");
		CustomiesItemFactory::getInstance()->registerItem(DiamondDrill::class, "fici:diamond_drill", "Diamond Drill");
		CustomiesItemFactory::getInstance()->registerItem(MegaDrill::class, "fici:mega_drill", "Mega Drill");
		CustomiesItemFactory::getInstance()->registerItem(AspectOfTheEnd::class, "fici:aspect_of_the_end", "Aspect of the End");
		CustomiesItemFactory::getInstance()->registerItem(GiantSword::class, "fici:giant_sword", "Giant's Sword");
		CustomiesItemFactory::getInstance()->registerItem(Hyperion::class, "fici:hyperion", "Hyperion");
		CustomiesItemFactory::getInstance()->registerItem(LunabyLightstick::class, "fici:lunaby_lightstick", "Lunaby Light Stick");
	}
}