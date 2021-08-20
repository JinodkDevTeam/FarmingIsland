<?php
declare(strict_types=1);

namespace Mail;

use Generator;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{

	private DataConnector $db;
	private Mail $mail;

	public const INIT = "mail.init";
	public const REGISTER = "mail.register";
	public const REMOVE = "mail.remove";
	public const SELECT_ALL = "mail.select.all";
	public const SELECT_FROM = "mail.select.from";
	public const SELECT_TO = "mail.select.to";
	public const SELECT_ID = "mail.select.id";
	public const UPDATE_ISREAD = "mail.update.isread";
	public const UPDATE_ISCLAIMED = "mail.update.isclaimed";

	public function __construct(Mail $mail){
		$this->mail = $mail;
	}

	private function getMail(): Mail{
		return $this->mail;
	}

	public function init(): void{
		$this->db = libasynql::create($this->getMail(), $this->getMail()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);

		$this->db->executeGeneric(self::INIT);
	}

	public function close(): void{
		if (isset($this->db)) $this->db->close();
	}

	public function asyncSelect(string $query, array $args): Generator{
		$this->db->executeSelect($query, $args, yield, yield Await::REJECT);
		return yield Await::ONCE;
	}

	public function selectAll(): Generator{
		return yield $this->asyncSelect(self::SELECT_ALL, []);
	}

	public function selectFrom(string $name): Generator{
		return yield $this->asyncSelect(self::SELECT_FROM, [
			"name" => $name
		]);
	}

	public function selectTo(string $name): Generator{
		return yield $this->asyncSelect(self::SELECT_TO, [
			"name" => $name
		]);
	}

	public function selectId(int $id){
		return yield $this->asyncSelect(self::SELECT_ID, [
			"id" => $id
		]);
	}

	public function updateIsRead(int $id, bool $value): void{
		$this->db->executeChange(self::UPDATE_ISREAD, [
			"id" => $id,
			"isread" => $value
		]);
	}

	public function updateIsClaimed(int $id, bool $value): void{
		$this->db->executeChange(self::UPDATE_ISCLAIMED, [
			"id" => $id,
			"isclaimed" => $value
		]);
	}



}