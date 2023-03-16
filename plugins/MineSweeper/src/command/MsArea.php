<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command;

use CortexPE\Commando\BaseCommand;
use NgLam2911\MineSweeper\command\subcmds\AddPlayerArea;
use NgLam2911\MineSweeper\command\subcmds\ClearBoardArea;
use NgLam2911\MineSweeper\command\subcmds\CreateArea;
use NgLam2911\MineSweeper\command\subcmds\ListAreas;
use NgLam2911\MineSweeper\command\subcmds\ListPlayersArea;
use NgLam2911\MineSweeper\command\subcmds\RemoveArea;
use NgLam2911\MineSweeper\command\subcmds\RemovePlayerArea;
use NgLam2911\MineSweeper\command\subcmds\SetBoard;
use NgLam2911\MineSweeper\command\subcmds\SetPlayPosArea;
use NgLam2911\MineSweeper\command\subcmds\SetTextureAreas;
use pocketmine\command\CommandSender;

class MsArea extends BaseCommand{

	protected function prepare() : void{
		$this->registerSubCommand(new CreateArea("createarea", "Create area"));
		$this->registerSubCommand(new RemoveArea("removearea", "Remove area"));
		$this->registerSubCommand(new RemovePlayerArea("removeplayer", "Remove player from area"));
		$this->registerSubCommand(new AddPlayerArea("addplayer", "Add player to area"));
		$this->registerSubCommand(new ListPlayersArea("listplayers", "List players in area"));
		$this->registerSubCommand(new SetPlayPosArea("setplaypos", "Set play position"));
		$this->registerSubCommand(new SetBoard("setboard", "Set board"));
		$this->registerSubCommand(new ClearBoardArea("clearboard", "Clear board"));
		$this->registerSubCommand(new ListAreas("listareas", "List areas"));
		$this->registerSubCommand(new SetTextureAreas("settexture", "Set texture"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$sender->sendMessage("No u");
	}
}