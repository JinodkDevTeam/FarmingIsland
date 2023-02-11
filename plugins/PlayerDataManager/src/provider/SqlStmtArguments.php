<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\provider;

class SqlStmtArguments{
	/**
	 * THIS CLASS IS ONLY AVAILABLE FOR INTERNAL USE
	 * DO NOT USE THIS CLASS AS API IN YOUR PLUGIN
	 */

	public static function register_player(string $xuid, string $gametag) : array{
		return [
			"xuid" => $xuid,
			"gametag" => $gametag
		];
	}

	public static function register_profile(string $profile_name, string $xuid, string $savekey) : array{
		return [
			"profile_name" => $profile_name,
			"xuid" => $xuid,
			"savekey" => $savekey
		];
	}

	public static function rm_p_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag
		];
	}

	public static function rm_p_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid
		];
	}

	public static function rm_profile_id(int $profile_id) : array{
		return [
			"profile_id" => $profile_id
		];
	}

	public static function rm_profile_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid
		];
	}

	public static function rm_profile_savekey(string $savekey) : array{
		return [
			"savekey" => $savekey
		];
	}

	public static function rm_profile_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag
		];
	}

	public static function update_gametag(string $gametag, string $xuid) : array{
		return [
			"gametag" => $gametag,
			"xuid" => $xuid
		];
	}

	public static function update_current_profile(int $profile_id, string $xuid) : array{
		return [
			"profile_id" => $profile_id,
			"xuid" => $xuid
		];
	}

	public static function update_profile_name(string $profile_name, int $profile_id) : array{
		return [
			"profile_name" => $profile_name,
			"profile_id" => $profile_id
		];
	}

	public static function update_profile_xuid(string $xuid, int $profile_id) : array{
		return [
			"xuid" => $xuid,
			"profile_id" => $profile_id
		];
	}

	public static function select_p_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag
		];
	}

	public static function select_p_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid
		];
	}

	public static function select_p_prefix(string $prefix) : array{
		return [
			"prefix" => $prefix
		];
	}

	public static function select_profile_id(int $profile_id) : array{
		return [
			"profile_id" => $profile_id
		];
	}

	public static function select_profile_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid
		];
	}

	public static function select_profile_savekey(string $savekey) : array{
		return [
			"savekey" => $savekey
		];
	}

	public static function select_profile_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag
		];
	}

	public static function select_current_profile_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid
		];
	}

	public static function select_current_profile_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag
		];
	}
}