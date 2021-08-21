<?php
declare(strict_types=1);

namespace Mail;

class Mail{

	protected int $id = -1;
	protected string $from = "";
	protected string $to = "";
	protected string $title = "";
	protected string $msg = "";
	protected string $items = "";
	protected int $time = 0;
	protected bool $isread = false;
	protected bool $isclaimed = false;

	public static function fromArray(array $data): Mail{
		return new Mail(
			$data["Id"],
			$data["FromName"],
			$data["ToName"],
			$data["Title"],
			$data["Msg"],
			$data["Items"],
			$data["Time"],
			$data["IsRead"],
			$data["IsClaimed"]
		);
	}

	public function toArray(): array{
		$data["Id"] = $this->getId();
		$data["FromName"] = $this->getFrom();
		$data["ToName"] = $this->getTo();
		$data["Title"] = $this->getTitle();
		$data["Msg"] = $this->getMsg();
		$data["Items"] = $this->getItems();
		$data["Time"] = $this->getTime();
		$data["IsRead"] = $this->isRead();
		$data["IsClaimed"] = $this->isClaimed();
		return $data;
	}

	public function __construct(int $id = 0, string $from = "", string $to = "", string $title = "", string $msg = "", string $items = "", int $time = 0, bool $isread = false, bool $isclaimed = false){
		$this->id = $id;
		$this->from = $from;
		$this->to = $to;
		$this->title = $title;
		$this->msg = $msg;
		$this->items = $items;
		$this->time = $time;
		$this->isread = $isread;
		$this->isclaimed = $isclaimed;
	}

	public function getId(): int{
		return $this->id;
	}

	public function getFrom(): string{
		return $this->from;
	}

	public function getTo(): string{
		return $this->to;
	}

	public function getTitle(): string{
		return $this->title;
	}

	public function getMsg(): string{
		return $this->msg;
	}

	public function getItems(): string{
		return $this->items;
	}

	public function getTime(): int{
		return $this->time;
	}

	public function isClaimed(): bool{
		return $this->isclaimed;
	}

	public function isRead(): bool{
		return $this->isread;
	}

	public function setRead(bool $value): void{
		$this->isread = $value;
	}

	public function setClaimed(bool $value): void{
		$this->isclaimed = $value;
	}
}