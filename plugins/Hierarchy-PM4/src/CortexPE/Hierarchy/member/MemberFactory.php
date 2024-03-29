<?php

/***
 *        __  ___                           __
 *       / / / (_)__  _________ ___________/ /_  __  __
 *      / /_/ / / _ \/ ___/ __ `/ ___/ ___/ __ \/ / / /
 *     / __  / /  __/ /  / /_/ / /  / /__/ / / / /_/ /
 *    /_/ /_/_/\___/_/   \__,_/_/   \___/_/ /_/\__, /
 *                                            /____/
 *
 * Hierarchy - Role-based permission management system
 * Copyright (C) 2019-Present CortexPE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace CortexPE\Hierarchy\member;


use CortexPE\Hierarchy\data\member\SQLMemberDS;
use CortexPE\Hierarchy\Hierarchy;
use pocketmine\player\OfflinePlayer;
use pocketmine\player\Player;
use function is_string;

class MemberFactory{
	/** @var Hierarchy */
	protected $plugin;
	/** @var Member[] */
	protected $onlineMembers = [];

	public function __construct(Hierarchy $plugin){
		$this->plugin = $plugin;
	}

	public function createSession(Player $player) : void{
		$this->getMember($player); // just call this function, does the same thing
	}

	/**
	 * @param Player|OfflinePlayer|string $player
	 *
	 * @return BaseMember
	 */
	public function getMember(Player|OfflinePlayer|string $player) : BaseMember{
		if(is_string($player)){
			$player = $this->plugin->getServer()->getOfflinePlayer((string) $player);
		}
		$newMember = false;
		if($player instanceof Player){
			if(!isset($this->onlineMembers[($n = $player->getName())])){
				$this->onlineMembers[$n] = new Member($this->plugin, $player);
				$newMember = true;
				$this->plugin->getLogger()->debug("Created {$player->getName()}'s Session");
			}
			$m = $this->onlineMembers[$n];
		}else{
			$m = new OfflineMember($this->plugin, $player->getName());
			$newMember = true;
		}
		if($newMember){
			($ds = $this->plugin->getMemberDataSource())->loadMemberData($m);
			if($m instanceof OfflineMember && $ds instanceof SQLMemberDS){
				/**
				 * TODO:
				 *   Make this better...
				 *   the sole reason this hack exists is because of the typical usage of OfflineMember,
				 *   data has to be manipulated right away therefore it has to be available right away.
				 */
				$ds->getDB()->waitAll();
			}
		}

		return $m;
	}

	public function shutdown() : void{
		foreach($this->onlineMembers as $member){
			$this->destroySession($member->getPlayer());
		}
	}

	public function destroySession(Player $player) : void{
		$this->plugin->getLogger()->debug("Destroying {$player->getName()}'s Session");
		$k = $player->getName();
		if(isset($this->onlineMembers[$k])){
			$this->onlineMembers[$k]->onDestroy();
		}
		unset($this->onlineMembers[$k]);
	}
}