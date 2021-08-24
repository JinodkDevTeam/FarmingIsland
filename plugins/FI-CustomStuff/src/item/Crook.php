<?php
declare(strict_types=1);

namespace CustomStuff\item;

use CustomStuff\CustomStuff;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Leaves;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;

class Crook implements Listener
{
    /** @var bool[] */
    public array $isBreaking = [];
    /** @var int[] */
    public array $breaked = [];

    private CustomStuff $core;

    public function __construct(CustomStuff $core)
    {
        $this->core = $core;
    }

    public function getCore(): CustomStuff
	{
		return $this->core;
	}

    public function isBreaking(Player $player): bool
    {
        if (isset($this->isBreaking[$player->getName()]))
        {
            return $this->isBreaking[$player->getName()];
        }
        else return false;
    }

    /**
     * @param BlockBreakEvent $event
     * @priority HIGHEST
     * @ignoreCancelled true
     */
    public function onBreak(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        $block = $event->getBlock();

        if ($item->getId() !== ItemIds::STICK) return;
        if ($item->getNamedTag()->getTag("crook") == null) return;

        if ($block instanceof Leaves)
        {
            if ($this->isBreaking($player))
            {
                return;
            }
            $this->isBreaking[$player->getName()] = true;
            $this->breaked[$player->getName()] = 0;
            $this->CrookMine($block, $item, $player);
            $this->breaked[$player->getName()] = 0;
            $this->isBreaking[$player->getName()] = false;
        }
    }

    /*//RECURSION (Wait, did you mean RECURSION ?)

    public function CrookMineR(Block $block, Item $item, Player $player, array &$ignore = [])
    {
        if($block->isValid())
        {
            if ($this->breaked[$player->getName()] > 1100)
            {
                return;
            }
            $ignore[] = $block->asVector3()->__toString();
            $this->breaked[$player->getName()]++;
            foreach($block->getAllSides() as $side)
            {
                if((($side instanceof Leaves) or ($side instanceof Leaves2)) and !in_array($side->asVector3()->__toString(), $ignore))
                {
                    $this->CrookMine($side, $item, $player, $ignore);
                }
            }
            $block->getLevel()->useBreakOn($block, $item, $player, true);
        }
    }*/

    //DYNAMIC PROGRAMMING
    //Algorithm by JINODK

    /**
     * @param Block $block
     * @param Block[] $pending
     * @return Block[]
     */

    public function getAllSide (Block $block, array $pending): array
    {
        $blocks = [];
        for ($x = $block->getPosition()->getX() - 1; $x <= $block->getPosition()->getX() + 1; $x++)
            for ($y = $block->getPosition()->getY() - 1; $y <= $block->getPosition()->getY() + 1; $y++)
                for ($z = $block->getPosition()->getZ() - 1; $z <= $block->getPosition()->getZ() + 1; $z++)
                {
                    if ($x == $block->getPosition()->getX() and $y == $block->getPosition()->getY() and $z == $block->getPosition()->getZ())
                    {
                        continue;
                    }
                    $side = $block->getPosition()->getWorld()->getBlockAt($x, $y, $z);
                    if ($side instanceof Leaves)
                    {
                        if (!$this->isChecked($side, $pending))
                        {
                            array_push($blocks, $side);
                        }
                    }
                }
        return $blocks;
    }

    /**
     * @param Block $block
     * @param Block[] $pending
     * @return bool
     */
    public function isChecked(Block $block, array $pending): bool
    {
        if (in_array($block, $pending)) return true;
        return false;
    }

    public function CrookMine (Block $blockbreak, Item $item, Player $player)
    {
        $pending = [];
        $pos = $blockbreak;

        while (true)
        {
            if ($this->breaked[$player->getName()] > 100)
            {
                break;
            }
            $sides = $this->getAllSide($pos, $pending);

            if ($sides !== [])
            {
                $pending = array_merge($pending, $sides);
            }

            if ($pos !== $blockbreak)
            {
                $pos->getPosition()->getWorld()->useBreakOn($pos , $item, $player, true);
                $this->breaked[$player->getName()]++;
            }

            if (!isset($pending))
            {
                break;
            }
            if ($pending == [])
            {
                break;
            }

            $pos = $pending[0];
            unset($pending[0]);
            $pending = array_values($pending);
        }
    }

}