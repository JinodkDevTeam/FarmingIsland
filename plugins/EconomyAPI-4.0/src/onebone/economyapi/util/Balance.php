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

namespace onebone\economyapi\util;

use onebone\economyapi\currency\Currency;

class Balance{
	/** @var Currency */
	private $currency;
	/** @var float */
	private $amount;

	public function __construct(Currency $currency, float $amount){
		$this->currency = $currency;
		$this->amount = $amount;
	}

	public function getCurrency() : Currency{
		return $this->currency;
	}

	public function setCurrency() : Currency{
		return $this->currency;
	}

	public function getAmount() : float{
		return $this->amount;
	}

	public function setAmount(float $amount){
		$this->amount = $amount;
	}
}
