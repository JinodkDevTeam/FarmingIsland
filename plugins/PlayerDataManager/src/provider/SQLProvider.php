<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\provider;

use Generator;
use NgLam2911\PlayerDataManager\PDM;
use NgLam2911\PlayerDataManager\provider\SqlStmtArgs as Args;
use NgLam2911\PlayerDataManager\provider\SqlStmtConstant as Stmt;
use NgLam2911\PlayerDataManager\utils\ProfileTypes;
use NgLam2911\PlayerDataManager\utils\type\PdmPlayer;
use NgLam2911\PlayerDataManager\utils\type\PdmProfile;
use NgLam2911\PlayerDataManager\utils\type\PdmProfilePlayer;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use poggit\libasynql\SqlError;
use SOFe\AwaitGenerator\Await;

class SQLProvider{
	protected DataConnector $db;
	protected PDM $pdm;

	public function __construct(PDM $pdm){
		$this->pdm = $pdm;
	}

	protected function getPDM() : PDM{
		return $this->pdm;
	}

	public function load() : void{
		Await::g2c($this->initDatabase());
		$this->db->waitAll();
	}

	public function unload() : void{
		if(isset($this->db)) $this->db->close();
	}

	/**
	 * @return Generator<void>
	 */
	protected function initDatabase() : Generator{
		$this->db = libasynql::create($this->getPDM(), $this->getPDM()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql",
			"mysql" => "mysql.sql"
		]);
		try{
			yield from $this->db->asyncGeneric(Stmt::INIT_PLAYERS);
			yield from $this->db->asyncGeneric(Stmt::INIT_PROFILES);
			yield from $this->db->asyncGeneric(Stmt::INIT_PROFILE_PLAYER);
		}catch(SqlError $error){
			$this->getPDM()->getLogger()->error("Database initialization failed: " . $error->getMessage());
		}
		$this->getPDM()->getLogger()->info("Database initialized");
	}

	/**
	 * @param Player|PdmPlayer $player
	 *
	 * @return Generator<array{int, int}|null>
	 */
	public function registerPlayer(Player|PdmPlayer $player) : Generator{
		try{
			return yield from $this->db->asyncInsert(Stmt::REGISTER_PLAYER, Args::register_player(
				$player->getXuid(),
				$player->getName()
			));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param ProfileTypes|int $profile_type
	 *
	 * @return Generator<array{int, int}|null>
	 */
	public function registerProfile(ProfileTypes|int $profile_type) : Generator{
		$profile = PdmProfile::new($profile_type);
		try{
			return yield from $this->db->asyncInsert(Stmt::REGISTER_PROFILE, Args::register_profile(
				$profile->getProfileName(),
				$profile->getType()->getId(),
				$profile->getProfileUUID(),
			));
		}catch(SqlError){
			return null;
		}
	}

	public function registerProfilePlayer(PdmProfilePlayer $profile_player) : Generator{
		try{
			return yield from $this->db->asyncInsert(Stmt::REGISTER_PROFILE_PLAYER, Args::register_profile_player(
				$profile_player->getProfilePlayerUUID(),
				$profile_player->getProfileUUID(),
				$profile_player->getXuid()
			));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $gametag
	 *
	 * @return Generator<int|null>
	 */
	public function removePlayerGametag(string $gametag) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PLAYER_GAMETAG, Args::remove_player_gametag($gametag));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $xuid
	 *
	 * @return Generator<int|null>
	 */
	public function removePlayerXuid(string $xuid) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PLAYER_XUID, Args::remove_player_xuid($xuid));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param Player|PdmPlayer $player
	 *
	 * @return Generator<int|null>
	 */
	public function removePlayer(Player|PdmPlayer $player) : Generator{
		return yield from $this->removePlayerXuid($player->getXuid());
	}

	/**
	 * @param string $id
	 *
	 * @return Generator<int|null>
	 */
	public function removeProfileID(string $id) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_ID, Args::remove_profile_id($id));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $id
	 *
	 * @return Generator<int|null>
	 */
	public function removeProfilePlayerID(string $id) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_PLAYER_ID, Args::remove_profile_player_id($id));
		}catch(SqlError){
			return null;
		}
	}

	public function removeProfilePlayerXUID(string $xuid) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_PLAYER_XUID, Args::remove_profile_player_xuid($xuid));
		}catch(SqlError){
			return null;
		}
	}

	public function removeProfilePlayerProfileID(string $profile_id) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_PLAYER_PROFILE_ID, Args::remove_profile_player_profile_id($profile_id));
		}catch(SqlError){
			return null;
		}
	}

	public function removeProfilePlayerGametag(string $gametag) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_PLAYER_GAMETAG, Args::remove_profile_player_gametag($gametag));
		}catch(SqlError){
			return null;
		}
	}

	public function removeProfilePlayer(PdmProfilePlayer $profile_player) : Generator{
		return yield from $this->removeProfilePlayerID($profile_player->getProfilePlayerUUID());
	}

	/**
	 * @param string $gametag
	 * @param string $xuid
	 *
	 * @return Generator<int|null>
	 */
	public function updatePlayerGametag(string $gametag, string $xuid) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_GAMETAG, Args::update_gametag($gametag, $xuid));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $profile_id
	 * @param string $xuid
	 *
	 * @return Generator<int|null>
	 */
	public function updateCurrentProfile(string $profile_id, string $xuid) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_CURRENT_PROFILE, Args::update_current_profile($profile_id, $xuid));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $profile_name
	 * @param string $profile_id
	 *
	 * @return Generator<int|null>
	 */
	public function updateProfileName(string $profile_name, string $profile_id) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_PROFILE_NAME, Args::update_profile_name($profile_name, $profile_id));
		}catch(SqlError){
			return null;
		}
	}

	public function updateProfileType(ProfileTypes|int $profileType, string $profile_id) : Generator{
		if($profileType instanceof ProfileTypes) $profileType = $profileType->getId();
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_PROFILE_TYPE, Args::update_profile_type($profileType, $profile_id));
		}catch(SqlError){
			return null;
		}
	}

	public function updateProfilePlayerXuid(string $profile_player_id, string $xuid) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_PROFILE_PLAYER_XUID, Args::update_profile_player_xuid($profile_player_id, $xuid));
		}catch(SqlError){
			return null;
		}
	}

	public function updateProfilePlayerProfileID(string $profile_player_id, string $profile_id) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_PROFILE_PLAYER_PROFILE_ID, Args::update_profile_player_profile_id($profile_player_id, $profile_id));
		}catch(SqlError){
			return null;
		}
	}

	public function updateProfilePlayerInventory(string $profile_player_id, string $inventory) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_PROFILE_PLAYER_INVENTORY, Args::update_profile_player_inventory($profile_player_id, $inventory));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $gametag
	 *
	 * @return Generator<PdmPlayer|null|bool>
	 */
	public function selectPlayerGametag(string $gametag) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PLAYER_GAMETAG, Args::select_player_gametag($gametag));
			if(empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmPlayer($row["Gametag"], $row["Xuid"], $row["DefaultProfileID"]);
		}catch(SqlError){
			return false; //For error handling
		}
	}

	/**
	 * @param string $xuid
	 *
	 * @return Generator<PdmPlayer|null|bool>
	 */
	public function selectPlayerXuid(string $xuid) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PLAYER_XUID, Args::select_player_xuid($xuid));
			if(empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmPlayer($row["Gametag"], $row["Xuid"], $row["DefaultProfileID"]);
		}catch(SqlError){
			return false;
		}
	}

	/**
	 * @param string $prefix
	 *
	 * @return Generator<PdmPlayer[]|null>
	 */
	public function selectPlayerPrefix(string $prefix) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PLAYER_PREFIX, Args::select_player_prefix($prefix));
			/** @var PdmPlayer[] $result */
			$result = [];
			foreach($query_result as $row){
				$result[] = new PdmPlayer($row["Gametag"], $row["Xuid"], $row["DefaultProfileID"]);
			}
			return $result;
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $id
	 *
	 * @return Generator<PdmProfile|null|bool>
	 */
	public function selectProfileID(string $id) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_ID, Args::select_profile_id($id));
			if(empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["ProfileType"]);
		}catch(SqlError){
			return false;
		}
	}

	/**
	 * @param string $name
	 *
	 * @return Generator<PdmProfile[]|null>
	 */
	public function selectProfileName(string $name) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_NAME, Args::select_profile_name($name));
			if(empty($query_result)){
				return null;
			}
			/** @var PdmProfile[] $result */
			$result = [];
			foreach($query_result as $row){
				$result[] = new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["ProfileType"]);
			}
			return $result;
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param ProfileTypes|int $profileType
	 *
	 * @return Generator<PdmProfile[]|null>
	 */
	public function selectProfileType(ProfileTypes|int $profileType) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_TYPE, Args::select_profile_type($profileType));
			if(empty($query_result)){
				return null;
			}
			/** @var PdmProfile[] $result */
			$result = [];
			foreach($query_result as $row){
				$result[] = new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["ProfileType"]);
			}
			return $result;
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $xuid
	 *
	 * @return Generator<PdmProfile[]|null>
	 */
	public function selectProfileXuid(string $xuid) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_XUID, Args::select_profile_xuid($xuid));
			/** @var PdmProfile[] $result */
			$result = [];
			foreach($query_result as $row){
				$result[] = new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["ProfileType"]);
			}
			return $result;
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $profile_player_id
	 *
	 * @return Generator<PdmProfile|null|bool>
	 */
	public function selectProfileProfilePlayer(string $profile_player_id) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_PROFILEPLAYER, Args::select_profile_profileplayer($profile_player_id));
			/** @var PdmProfile[] $result */
			$result = [];
			$row = $query_result[0];
			return new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["ProfileType"]);
		}catch(SqlError){
			return false;
		}
	}

	/**
	 * @param string $gametag
	 *
	 * @return Generator<PdmProfile[]|null>
	 */
	public function selectProfileGametag(string $gametag) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_GAMETAG, Args::select_profile_gametag($gametag));
			/** @var PdmProfile[] $result */
			$result = [];
			foreach($query_result as $row){
				$result[] = new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["ProfileType"]);
			}
			return $result;
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $xuid
	 *
	 * @return Generator<PdmProfile|null|bool>
	 */
	public function selectCurrentProfileXuid(string $xuid) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_CURRENT_PROFILE_XUID, Args::select_current_profile_xuid($xuid));
			if(empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["ProfileType"]);
		}catch(SqlError){
			return false;
		}
	}

	/**
	 * @param string $gametag
	 *
	 * @return Generator<PdmProfile|null|bool>
	 */
	public function selectCurrentProfileGametag(string $gametag) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_CURRENT_PROFILE_GAMETAG, Args::select_current_profile_gametag($gametag));
			if(empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["ProfileType"]);
		}catch(SqlError){
			return false;
		}
	}
}