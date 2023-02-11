<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\provider;

use Generator;
use NgLam2911\PlayerDataManager\utils\type\PdmProfile;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use poggit\libasynql\SqlError;
use SOFe\AwaitGenerator\Await;
use NgLam2911\PlayerDataManager\PDM;
use NgLam2911\PlayerDataManager\utils\type\PdmPlayer;
use NgLam2911\PlayerDataManager\provider\SqlStmtConstant as Stmt;
use NgLam2911\PlayerDataManager\provider\SqlStmtArguments as Args;

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
	 * @param Player|PdmPlayer|PdmProfile $profile
	 *
	 * @return Generator<array{int, int}|null>
	 */
	public function registerProfile(Player|PdmPlayer|PdmProfile $profile) : Generator{
		if($profile instanceof Player or $profile instanceof PdmPlayer){
			$profile = PdmProfile::new($profile->getXuid());
		}
		try{
			return yield from $this->db->asyncInsert(Stmt::REGISTER_PROFILE, Args::register_profile(
				$profile->getProfileName(),
				$profile->getXuid(),
				$profile->getSavekey()
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
			return yield from $this->db->asyncChange(Stmt::REMOVE_PLAYER_GAMETAG, Args::rm_p_gametag($gametag));
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
			return yield from $this->db->asyncChange(Stmt::REMOVE_PLAYER_XUID, Args::rm_p_xuid($xuid));
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
	 * @param int $id
	 *
	 * @return Generator<int|null>
	 */
	public function removeProfileID(int $id) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_ID, Args::rm_profile_id($id));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $xuid
	 *
	 * @return Generator<int|null>
	 */
	public function removeProfileXuid(string $xuid) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_XUID, Args::rm_profile_xuid($xuid));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $savekey
	 *
	 * @return Generator<int|null>
	 */
	public function removeProfileSaveKey(string $savekey) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_SAVEKEY, Args::rm_profile_savekey($savekey));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $gametag
	 *
	 * @return Generator<int|null>
	 */
	public function removeProfileGametag(string $gametag) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::REMOVE_PROFILE_GAMETAG, Args::rm_profile_gametag($gametag));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $gametag
	 * @param string $xuid
	 *
	 * @return Generator<int|null>
	 */
	public function updatePlayerGametag(string $gametag, string $xuid) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_PLAYER_GAMETAG, Args::update_gametag($gametag, $xuid));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param int    $profile_id
	 * @param string $xuid
	 *
	 * @return Generator<int|null>
	 */
	public function updateCurrentProfile(int $profile_id, string $xuid) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_CURRENT_PROFILE, Args::update_current_profile($profile_id, $xuid));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $profile_name
	 * @param int    $profile_id
	 *
	 * @return Generator<int|null>
	 */
	public function updateProfileName(string $profile_name, int $profile_id) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_PROFILE_NAME, Args::update_profile_name($profile_name, $profile_id));
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $xuid
	 * @param int    $profile_id
	 *
	 * @return Generator<int|null>
	 */
	public function updateProfileXuid(string $xuid, int $profile_id) : Generator{
		try{
			return yield from $this->db->asyncChange(Stmt::UPDATE_PROFILE_XUID, Args::update_profile_xuid($xuid, $profile_id));
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
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PLAYER_GAMETAG, Args::select_p_gametag($gametag));
			if (empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmPlayer($row["Gametag"], $row["Xuid"], $row["CurrentProfileID"]);
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
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PLAYER_XUID, Args::select_p_xuid($xuid));
			if (empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmPlayer($row["Gametag"], $row["Xuid"], $row["CurrentProfileID"]);
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
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PLAYER_PREFIX, Args::select_p_prefix($prefix));
			/** @var PdmPlayer[] $result */
			$result = [];
			foreach($query_result as $row){
				$result[] = new PdmPlayer($row["Gametag"], $row["Xuid"], $row["CurrentProfileID"]);
			}
			return $result;
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param int $id
	 *
	 * @return Generator<PdmProfile|null|bool>
	 */
	public function selectProfileID(int $id) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_ID, Args::select_profile_id($id));
			if (empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["Xuid"], $row["SaveKey"]);
		}catch(SqlError){
			return false;
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
				$result[] = new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["Xuid"], $row["SaveKey"]);
			}
			return $result;
		}catch(SqlError){
			return null;
		}
	}

	/**
	 * @param string $savekey
	 *
	 * @return Generator<PdmProfile|null|bool>
	 */
	public function selectProfileSaveKey(string $savekey) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_SAVEKEY, Args::select_profile_savekey($savekey));
			if (empty($query_result)){
				return yield null;
			}
			$row = $query_result[0];
			return new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["Xuid"], $row["SaveKey"]);
		}catch(SqlError){
			return false;
		}
	}

	/**
	 * @param string $gametag
	 *
	 * @return Generator<PdmProfile[]|bool>
	 */
	public function selectProfileGametag(string $gametag) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_PROFILE_GAMETAG, Args::select_profile_gametag($gametag));
			/** @var PdmProfile[] $result */
			$result = [];
			foreach($query_result as $row){
				$result[] = new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["Xuid"], $row["SaveKey"]);
			}
			return $result;
		}catch(SqlError){
			return false;
		}
	}

	/**
	 * @param string $xuid
	 *
	 * @return Generator<PdmProfile|bool>
	 */
	public function selectCurrentProfileXuid(string $xuid) : Generator{
		try{
			/** @var array[] $query_result */
			$query_result = yield from $this->db->asyncSelect(Stmt::SELECT_CURRENT_PROFILE_XUID, Args::select_current_profile_xuid($xuid));
			if (empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["Xuid"], $row["SaveKey"]);
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
			if (empty($query_result)){
				return null;
			}
			$row = $query_result[0];
			return new PdmProfile($row["ProfileID"], $row["ProfileName"], $row["Xuid"], $row["SaveKey"]);
		}catch(SqlError){
			return false;
		}
	}
}