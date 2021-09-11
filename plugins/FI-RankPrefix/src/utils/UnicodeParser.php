<?php
declare(strict_types=1);

namespace RankPrefix\utils;

class UnicodeParser{

	public static function fromCode(string $code) : string{
		$unicodeChar = "\u" . $code;
		return (string) json_decode('"' . $unicodeChar . '"');
	}

	public static function fromCharactor(string $charactor) : string{
		return json_encode($charactor);
	}
}