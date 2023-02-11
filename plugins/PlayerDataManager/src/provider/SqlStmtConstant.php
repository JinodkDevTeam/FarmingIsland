<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\provider;

final class SqlStmtConstant{
	public const INIT_PLAYERS = "pdm.init.players";
	public const INIT_PROFILES = "pdm.init.profiles";
	public const REGISTER_PLAYER = "pdm.register.player";
	public const REGISTER_PROFILE = "pdm.register.profile";
	public const REMOVE_PLAYER_GAMETAG = "pdm.remove.player.gametag";
	public const REMOVE_PLAYER_XUID = "pdm.remove.player.xuid";
	public const REMOVE_PROFILE_ID = "pdm.remove.profile.id";
	public const REMOVE_PROFILE_XUID = "pdm.remove.profile.xuid";
	public const REMOVE_PROFILE_SAVEKEY = "pdm.remove.profile.savekey";
	public const REMOVE_PROFILE_GAMETAG = "pdm.remove.profile.gametag";
	public const UPDATE_PLAYER_GAMETAG = "pdm.update.gametag";
	public const UPDATE_CURRENT_PROFILE = "pdm.update.current_profile";
	public const UPDATE_PROFILE_NAME = "pdm.update.profile_name";
	public const UPDATE_PROFILE_XUID = "pdm.update.profile_xuid";
	public const SELECT_PLAYER_GAMETAG = "pdm.select.player.gametag";
	public const SELECT_PLAYER_XUID = "pdm.select.player.xuid";
	public const SELECT_PLAYER_PREFIX = "pdm.select.player.prefix";
	public const SELECT_PROFILE_ID = "pdm.select.profile.id";
	public const SELECT_PROFILE_XUID = "pdm.select.profile.xuid";
	public const SELECT_PROFILE_SAVEKEY = "pdm.select.profile.savekey";
	public const SELECT_PROFILE_GAMETAG = "pdm.select.profile.gametag";
	public const SELECT_CURRENT_PROFILE_XUID = "pdm.select.current_profile.xuid";
	public const SELECT_CURRENT_PROFILE_GAMETAG = "pdm.select.current_profile.gametag";
}