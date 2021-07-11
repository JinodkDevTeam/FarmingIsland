<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\Sell;

use NgLamVN\GameHandle\Core;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class SellHandler
{
	public const GLOBAL_BUFF = 0;
	public const RANK_BUFF = 10;

	public const BUFF_RANK = ["Vip", "VipPlus", "Member", "Youtuber"];

	public Core $core;

	public array $data;

	public Config $cfg;

	public function __construct(Core $core) {
		$this->core = $core;
		$this->register();
	}

	public function getCore(): Core
	{
		return $this->core;
	}

	public function getSellDataFolder(): string
	{
		$folder = $this->getCore()->getDataFolder() . "Sell/";
		if (!file_exists($folder))
		{
			@mkdir($folder);
		}
		return $folder;
	}

	public function getDataConfig()
	{
		$this->cfg = new Config($this->getSellDataFolder() . "sell.yml", Config::YAML);
		$this->data = $this->cfg->getAll();
	}

	public function register()
	{
		$this->getDataConfig();
	}

	public function toPrice (Item $item): float
	{
		$id = $item->getId();
		$meta = $item->getMeta();
		$count = $item->getCount();

		if ($meta !== 0)
		{
			$pos = $id . "/" . $meta;
		}
		else
		{
			$pos = (string)$id;
		}
		if (!isset($this->data[$pos]))
		{
			return -1;
		}
		return (float)$this->data[$pos] * $count;
	}

	public function isBuff(Player $player): bool
	{
		if (in_array($this->getCore()->getPlayerGroupName($player), self::BUFF_RANK))
		{
			return true;
		}
		return false;
	}

	public function sellHand(Player $player): void
	{
		$item = $player->getInventory()->getItemInHand();
		$price = $this->toPrice($item);
		if ($price < 0)
		{
			$player->sendMessage("Can't sold this item !");
			return;
		}
		if ($this->isBuff($player))
		{
			$buff = self::RANK_BUFF + self::GLOBAL_BUFF;
		}
		else
		{
			$buff = self::GLOBAL_BUFF;
		}
		$price += $price * ($buff/100);

		$player->sendMessage("Sold " . $item->getCount() . " items for " . $price . " xu (+" . $buff ." percent)");
		EconomyAPI::getInstance()->addMoney($player, $price);
		$player->getInventory()->remove($item);
	}

	public function sellAll(Player $player)
	{
		$inv = $player->getInventory();
		$total = 0;
		$totalcount = 0;

		if ($this->isBuff($player))
		{
			$buff = self::RANK_BUFF + self::GLOBAL_BUFF;
		}
		else
		{
			$buff = self::GLOBAL_BUFF;
		}

		foreach($inv->getContents() as $item)
		{
			$price = $this->toPrice($item);
			if ($price < 0)
			{
				continue;
			}
			$price += $price * ($buff/100);
			$total += $price;
			$totalcount += $item->getCount();
			$inv->remove($item);
		}

		$player->sendMessage("Sold " . $totalcount . " items for " . $total . " xu (+" . $buff ." percent)");
		EconomyAPI::getInstance()->addMoney($player, $total);
	}
}