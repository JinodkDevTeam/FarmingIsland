<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\provider;

class SqlStmtArgs{
	/**
	* This class is generated automatically, do NOT modify it by hand.
	* See JinodkDevTeam\utils\php\AutoGen\LibasynqlHelperAutoGen.php
	*/
	public static function register_player(string $gametag, string $xuid) : array{
		return [
			"gametag" => $gametag,
			"xuid" => $xuid,
		];
	}
	public static function register_profile(string $profile_name, int $profile_type, string $profile_id) : array{
		return [
			"profile_name" => $profile_name,
			"profile_type" => $profile_type,
			"profile_id" => $profile_id,
		];
	}
	public static function register_profile_player(string $profile_player_id, string $profile_id, string $xuid) : array{
		return [
			"profile_player_id" => $profile_player_id,
			"profile_id" => $profile_id,
			"xuid" => $xuid,
		];
	}
	public static function remove_player_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag,
		];
	}
	public static function remove_player_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid,
		];
	}
	public static function remove_profile_id(string $profile_id) : array{
		return [
			"profile_id" => $profile_id,
		];
	}
	public static function remove_profile_player_id(string $profile_player_id) : array{
		return [
			"profile_player_id" => $profile_player_id,
		];
	}
	public static function remove_profile_player_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid,
		];
	}
	public static function remove_profile_player_profile_id(string $profile_id) : array{
		return [
			"profile_id" => $profile_id,
		];
	}
	public static function remove_profile_player_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag,
		];
	}
	public static function update_gametag(string $gametag, string $xuid) : array{
		return [
			"gametag" => $gametag,
			"xuid" => $xuid,
		];
	}
	public static function update_current_profile(int $profile_id, string $xuid) : array{
		return [
			"profile_id" => $profile_id,
			"xuid" => $xuid,
		];
	}
	public static function update_profile_name(string $profile_name, int $profile_id) : array{
		return [
			"profile_name" => $profile_name,
			"profile_id" => $profile_id,
		];
	}
	public static function update_profile_type(int $profile_type, int $profile_id) : array{
		return [
			"profile_type" => $profile_type,
			"profile_id" => $profile_id,
		];
	}
	public static function update_profile_player_xuid(int $profile_player_id, string $xuid) : array{
		return [
			"profile_player_id" => $profile_player_id,
			"xuid" => $xuid,
		];
	}
	public static function update_profile_player_profile_id(int $profile_player_id, int $profile_id) : array{
		return [
			"profile_player_id" => $profile_player_id,
			"profile_id" => $profile_id,
		];
	}
	public static function update_profile_player_inventory(int $profile_player_id, string $inventory) : array{
		return [
			"profile_player_id" => $profile_player_id,
			"inventory" => $inventory,
		];
	}
	public static function select_player_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag,
		];
	}
	public static function select_player_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid,
		];
	}
	public static function select_player_prefix(string $prefix) : array{
		return [
			"prefix" => $prefix,
		];
	}
	public static function select_profile_id(int $profile_id) : array{
		return [
			"profile_id" => $profile_id,
		];
	}
	public static function select_profile_name(string $profile_name) : array{
		return [
			"profile_name" => $profile_name,
		];
	}
	public static function select_profile_type(int $profile_type) : array{
		return [
			"profile_type" => $profile_type,
		];
	}
	public static function select_profile_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid,
		];
	}
	public static function select_profile_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag,
		];
	}
	public static function select_profile_profileplayer(string $profile_player_id) : array{
		return [
			"profile_player_id" => $profile_player_id,
		];
	}
	public static function select_current_profile_xuid(string $xuid) : array{
		return [
			"xuid" => $xuid,
		];
	}
	public static function select_current_profile_gametag(string $gametag) : array{
		return [
			"gametag" => $gametag,
		];
	}
}
