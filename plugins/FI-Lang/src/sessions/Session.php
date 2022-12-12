<?php
declare(strict_types=1);

namespace FILang\sessions;

class Session{
	/** @var string */
	private string $lang;
	public function __construct(string $lang){
		$this->lang = $lang;
	}

	public function getLang() : string{
		return $this->lang;
	}

	public function setLang(string $lang) : void{
		$this->lang = $lang;
	}
}