<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\provider\SqliteProvider;
use Bazaar\utils\OrderDataHelper;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class CategoryMenu extends BaseUI{

	protected ?array $category = null;

	public function __construct(Player $player, ?array $category = null){
		$this->category = $category;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			if ($this->category == null){
				$shop = $this->getBazaar()->getShopYAMLProvider()->getAll();
			} else {
				$shop = $this->category;
			}
			$form = new SimpleForm(function(Player $player, ?int $data) use ($shop){
				if(!isset($data)) return;
				if (is_array($shop[array_keys($shop)[$data]])){
					new CategoryMenu($player, $shop[array_keys($shop)[$data]]);
				} else {
					new ItemUI($player, $shop[array_keys($shop)[$data]]);
				}
			});
			foreach(array_keys($shop) as $item){
				if (is_array($shop[$item])){
					$form->addButton($item);
				} else {
					$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_ITEMID_SORT_PRICE, ["itemid" => (int)$shop[$item]]);
					if(empty($data)){
						$buy = "N/A";
					}else{
						$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
						$buy = $order->getPrice();
					}
					$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_SELL_ITEMID_SORT_PRICE, ["itemid" => (int)$shop[$item]]);
					if(empty($data)){
						$sell = "N/A";
					}else{
						$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
						$sell = $order->getPrice();
					}
					$form->addButton(ItemUtils::toName($shop[$item]) . "\n" . "Buy: " . $sell . " Sell: " . $buy);
				}
			}
			$form->setTitle("Bazaar Shop");
			$player->sendForm($form);
		});
	}
}