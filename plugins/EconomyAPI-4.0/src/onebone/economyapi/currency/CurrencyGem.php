<?php

/*
 * EconomyS, the massive economy plugin with many features for PocketMine-MP
 * Copyright (C) 2013-2021  onebone <me@onebone.me>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace onebone\economyapi\currency;

use pocketmine\player\Player;

class CurrencyGem implements Currency{
	public function getName() : string{
		return 'Gem';
	}

	public function isAvailableTo(Player $player) : bool{
		return true;
	}

	public function isExposed() : bool{
		return true;
	}

	public function getDefaultMoney() : float{
		return 0;
	}

	public function getSymbol() : string{
		return 'gem';
	}

	public function format(float $money) : string{
		$money = floor($money * 100) / 100;
		return sprintf('%.2f gem', $money);
	}

	public function stringify(float $money) : string{
		$money = floor($money * 100) / 100;
		return sprintf('%d gem', $money);
	}
}
