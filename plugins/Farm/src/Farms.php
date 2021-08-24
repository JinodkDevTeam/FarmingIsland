<?php
declare(strict_types=1);

namespace Farms;

use pocketmine\block\BlockFactory;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\Farmland;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\ItemIds;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\world\World;

class Farms extends PluginBase implements Listener
{
    /** @var Config  */
    public Config $farmConfig, $speedConfig;
    /** @var array  */
    public array $farmData, $speedData;
    /** @var array $crops */
    public array $crops = [
        [ "item" => ItemIds::SEEDS, "block" => BlockLegacyIds::WHEAT_BLOCK ],
        [ "item" => ItemIds::CARROT,"block" => BlockLegacyIds::CARROT_BLOCK ],
        [ "item" => ItemIds::POTATO,"block" => BlockLegacyIds::POTATO_BLOCK ],
        [ "item" => ItemIds::BEETROOT,"block" => BlockLegacyIds::BEETROOT_BLOCK ],
        [ "item" => ItemIds::SUGARCANE,"block" => BlockLegacyIds::SUGARCANE_BLOCK ],
        [ "item" => ItemIds::SUGARCANE_BLOCK,"block" => BlockLegacyIds::SUGARCANE_BLOCK ],
        [ "item" => ItemIds::PUMPKIN_SEEDS,"block" => BlockLegacyIds::PUMPKIN_STEM ],
        [ "item" => ItemIds::MELON_SEEDS,"block" => BlockLegacyIds::MELON_STEM ],
        [ "item" => ItemIds::DYE,"block" => 127 ],
        [ "item" => ItemIds::CACTUS,"block" => BlockLegacyIds::CACTUS ]
    ];

    public function onEnable(): void
	{
        @mkdir($this->getDataFolder());

        $this->farmConfig = new Config($this->getDataFolder()."farmlist.yml", Config::YAML);
        $this->farmData = $this->farmConfig->getAll();

        $this->speedConfig = new Config($this->getDataFolder()."speed.yml", Config::YAML, [
            "growing-time" => 1200,
            "vip-growing-time" => 600,
            "op-growing-time" => 10,
            "member-growing-time" => 1080
        ]);
        $this->speedData = $this->speedConfig->getAll();

        $this->getScheduler()->scheduleRepeatingTask(new FarmsTask($this), 20);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onDisable(): void
	{
        $this->farmConfig->setAll($this->farmData );
        $this->farmConfig->save();

        $this->speedConfig->save();
    }
    public function onBlock(PlayerInteractEvent $event)
	{
        if (! $event->getPlayer()->hasPermission("Farms")and ! $event->getPlayer()->hasPermission("Farms.VIP" )) return;
        $block = $event->getBlock()->getSide(1 );

        // Cocoa bean
        if ($event->getItem()->getId() == ItemIds::DYE and $event->getItem()->getMeta() == 3) {
            $tree = $event->getBlock()->getSide($event->getFace());
            // Jungle wood
            if ($tree->getId() == BlockLegacyIds::WOOD and $tree->getMeta() == 3) {
                $event->getBlock()->getPosition()->getWorld()->setBlock($event->getBlock()->getSide($event->getFace())->getPosition(), VanillaBlocks::COCOA_POD(), true);
                return;
            }
        }

        // Farmland or sand
        if ($event->getBlock()->getId() == BlockLegacyIds::FARMLAND or $event->getBlock()->getId() == BlockLegacyIds::SAND) {
            foreach($this->crops as $crop){
                if ($event->getItem()->getId() == $crop["item"]) {
                    $key = $block->getPosition()->x.".".$block->getPosition()->y.".".$block->getPosition()->z;

                    $this->farmData[$key]['id'] = $crop["block"];
                    $this->farmData[$key]['damage'] = 0;
                    $this->farmData[$key]['level'] = $block->getPosition()->getWorld()->getFolderName();
                    $this->farmData[$key]['time'] = $this->makeTimestamp(date("Y-m-d H:i:s"));
                    if ($event->getPlayer()->hasPermission("Farms.OP"))
                    {
                        $growing = $this->speedData["op-growing-time"];
                    }
                    elseif ($event->getPlayer()->hasPermission("Farms.VIP"))
                    {
                        $growing = $this->speedData["vip-growing-time"];
                    }
                    elseif ($event->getPlayer()->hasPermission("Farms.Member"))
                    {
                        $growing = $this->speedData["member-growing-time"];
                    }
                    else
                    {
                        $growing = $this->speedData["growing-time"];
                    }
                    $this->farmData[$key]['growtime'] = $growing;
                    break;
                }
            }
        }
    }
    public function onBlockBreak(BlockBreakEvent $event) {
        $key = $event->getBlock()->getPosition()->x.".".$event->getBlock()->getPosition()->y.".".$event->getBlock()->getPosition()->z;
        if(isset($this->farmData[$key]))
        {
            unset($this->farmData[$key]);
        }
        if ($event->getBlock() instanceof Farmland)
        {
            $x = $event->getBlock()->getPosition()->x;
            $y = $event->getBlock()->getPosition()->y + 1;
            $z = $event->getBlock()->getPosition()->z;
            $key = $x.".".$y .".".$z;
            if(isset($this->farmData[$key]))
            {
                unset($this->farmData[$key]);
            }
        }
    }

    public function tick(): void{
        foreach(array_keys($this->farmData) as $key){
            if(!isset($this->farmData[$key]['id'])){
                unset($this->farmData[$key]);
                continue;
            }
            if(! isset($this->farmData[$key]['time'])){
                unset($this->farmData[$key]);
                break;
            }
            $progress = $this->makeTimestamp(date("Y-m-d H:i:s")) - $this->farmData[$key]['time'];
            if($progress < $this->farmData[$key]['growtime']){
                continue;
            }

            $level = isset($this->farmData[$key]['level']) ? $this->getServer()->getWorldManager()->getWorldByName($this->farmData[$key]['level']) : $this->getServer()->getWorldManager()->getDefaultWorld();
            if(!$level instanceof World)
                continue;

            $coordinates = explode(".", $key);
            $position = new Vector3((int)$coordinates[0], (int)$coordinates[1], (int)$coordinates[2]);

            if($this->updateCrops($key, $level, $position)){
                unset($this->farmData[$key]);
                break;
            }
            $this->farmData[$key]['time'] = $this->speedData["growing-time"];
        }
    }
    public function makeTimestamp($date) : bool|int {
        $yy = substr($date, 0, 4 );
        $mm = substr($date, 5, 2 );
        $dd = substr($date, 8, 2 );
        $hh = substr($date, 11, 2 );
        $ii = substr($date, 14, 2 );
        $ss = substr($date, 17, 2 );
        return mktime((int)$hh, (int)$ii, (int)$ss, (int)$mm, (int)$dd, (int)$yy );
    }

    /**
     * @param $key
     * @param World $level
     * @param Vector3 $position
     * @return bool
     */
    public function updateCrops($key, World $level, Vector3 $position) : bool{
		return match ($this->farmData[$key]['id']) {
			BlockLegacyIds::WHEAT_BLOCK, BlockLegacyIds::CARROT_BLOCK, BlockLegacyIds::POTATO_BLOCK, BlockLegacyIds::BEETROOT_BLOCK => $this->updateNormalCrops($key, $level, $position),
			BlockLegacyIds::SUGARCANE_BLOCK, BlockLegacyIds::CACTUS => $this->updateVerticalGrowingCrops($key, $level, $position),
			BlockLegacyIds::PUMPKIN_STEM, BlockLegacyIds::MELON_STEM => $this->updateHorizontalGrowingCrops($key, $level, $position),
			default => true,
		};
    }

    /**
     * @param $key
     * @param World $level
     * @param Vector3 $position
     * @return bool
     */
    public function updateNormalCrops($key, World $level, Vector3 $position): bool{
        if(++$this->farmData[$key]["damage"] >= 8){ //FULL GROWN!
            return true;
        }
        $downpos = new Vector3($position->x, $position->y - 1, $position->z);
        if ($level->getBlock($downpos)->getId() !== BlockLegacyIds::FARMLAND)
        {
            return true;
        }
        $level->setBlock($position, BlockFactory::getInstance()->get((int)$this->farmData[$key]["id"], (int)$this->farmData[$key]["damage"]));
        return false;
    }

    /**
     * @param $key
     * @param World $level
     * @param Vector3 $position
     * @return bool
     */
    public function updateVerticalGrowingCrops($key, World $level, Vector3 $position): bool {
        if(++$this->farmData[$key]["damage"] >= 4){ //FULL GROWN!
            return true;
        }
        $cropPosition = new Vector3((int)$position->x, (int)$position->y+$this->farmData[$key]["damage"], (int)$position->z);
        if($level->getBlockAt((int)$cropPosition->x, (int)$cropPosition->y, (int)$cropPosition->z)->getId() !== BlockLegacyIds::AIR){ //SOMETHING EXISTS
            return true;
        }
        $level->setBlock($cropPosition, BlockFactory::getInstance()->get((int)$this->farmData[$key]["id"], 0));
        return false;
    }

    /**
     * @param $key
     * @param World $level
     * @param Vector3 $position
     * @return bool
     */
    public function updateHorizontalGrowingCrops($key, World $level, Vector3 $position): bool{
        switch($this->farmData[$key]["id"]){
            case BlockLegacyIds::PUMPKIN_STEM:
                $cropBlock = VanillaBlocks::PUMPKIN();
                break;

            case BlockLegacyIds::MELON_STEM:
                $cropBlock = VanillaBlocks::MELON();
                break;
            default:
                return true;
        }
        if(++$this->farmData[$key]["damage"] >= 8){ // FULL GROWN!
            for($xOffset = - 1; $xOffset <= 1; $xOffset ++){
                for($zOffset = - 1; $zOffset <= 1; $zOffset ++){
                    if($xOffset === 0 and $zOffset === 0){ //STEM
                        continue;
                    }
                    $cropPosition = new Vector3((int)$position->x+$xOffset, (int)$position->y, (int)$position->z+$zOffset);
                    if($level->getBlockAt((int)$cropPosition->x, (int)$cropPosition->y, (int)$cropPosition->z)->getId() !== BlockLegacyIds::AIR){ //SOMETHING EXISTS
                        $level->setBlock($cropPosition, $cropBlock);
                        return true;
                    }
                }
            }
            return true;
        }

        $level->setBlock($position, BlockFactory::getInstance()->get((int)$this->farmData[$key]["id"], (int)$this->farmData[$key]["damage"]));
        return false;
    }
}