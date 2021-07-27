<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\PlayerStat;

use Exception;
use NgLamVN\GameHandle\Core;
use pocketmine\player\Player;

class PlayerStatManager
{
    /** @var PlayerStat[] */
    public array $stats;

    /**
     * PlayerStatManager constructor.
     */
    public function __construct()
    {
        //TODO: Construct
    }

    public function getCore(): Core
	{
		return Core::getInstance();
	}

	/**
	 * @param Player $player
	 *
	 * @return null|PlayerStat
	 */
    public function getPlayerStat(Player $player): ?PlayerStat
    {
        if (!isset($this->stats[$player->getName()]))
        {
			try
			{
				$this->registerPlayerStat($player);
			}
			catch(Exception)
			{
				$this->getCore()->getLogger()->error("Failed to register PlayerStat data: " . $player->getName());
				return null;
			}
		}
        return $this->stats[$player->getName()];
    }

    /**
     * @return PlayerStat[]
	 * @description Get All PlayerStat
     */
    public function getAllPlayerStat(): array
    {
        if (isset($this->stats)) return $this->stats;
        else return [];
    }

    /**
     * @param Player $player
     */
    public function removePlayerStat(Player $player)
    {
        if (isset($this->stats[$player->getName()]))
        {
            unset($this->stats[$player->getName()]);
        }
    }

	/**
	 * @throws Exception
	 */
	public function registerPlayerStat(Player $player, $overwrite = false)
    {
        if (isset($this->stats[$player->getName()]))
        {
            if (!$overwrite)
            {
                throw new Exception("Can't overwrite available PlayerStat");
            }
        }
        $this->stats[$player->getName()] = new PlayerStat($player);
    }
}