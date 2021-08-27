<?php
declare(strict_types=1);

namespace NgLamVN\InvCraft\menu;

use Closure;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;

class CraftMenu extends BaseMenu
{
    const VIxVI_PROTECTED_SLOT = [6, 7, 8, 15, 16, 17, 24, 25, 26, 33, 35, 42, 43, 44, 51, 52, 53];
    const VIxVI_RESULT_SLOT = 34;
    const IIIxIII_PROTECTED_SLOT = [0,1,2,3,4,5,6,7,8,9,10,14,15,16,17,18,19,23,24,26,27,28,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53];
    const IIIxIII_RESULT_SLOT = 25;

    public function menu(Player $player)
    {
        $this->menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        if ($this->mode == self::VIxVI_MODE)
        {
            $this->menu->setName($this->getLoader()->getProvider()->getMessage("menu.craft6x6"));
        }
        else
        {
            $this->menu->setName($this->getLoader()->getProvider()->getMessage("menu.craft3x3"));
        }
        $this->menu->setListener(Closure::fromCallable([$this, "MenuListener"]));
        $this->menu->setInventoryCloseListener(Closure::fromCallable([$this, "MenuCloseListener"]));
        $inv = $this->menu->getInventory();
        $ids = explode(":", $this->getLoader()->getProvider()->getMessage("menu.item"));
        $item = ItemFactory::getInstance()->get((int)$ids[0], (int)$ids[1]);
        for ($i = 0; $i <= 53; $i++)
        {
            if (in_array($i, $this->getProtectedSlot()))
            {
                $inv->setItem($i, $item);
            }
        }

        $this->menu->send($player);
    }

    public function MenuListener(InvMenuTransaction $transaction): InvMenuTransactionResult
    {
        if (in_array($transaction->getAction()->getSlot(), $this->getProtectedSlot()))
        {
            return $transaction->discard();
        }
        if ($transaction->getAction()->getSlot() === $this->getResultSlot())
        {
            $result = $this->menu->getInventory()->getItem($this->getResultSlot());
            if ($result->getId() == ItemIds::AIR)
            {
                return $transaction->discard();
            }
            $this->clearCraftItem();
            return $transaction->continue();
        }
        $slot = $transaction->getAction()->getSlot();
        $nextitem = $transaction->getAction()->getTargetItem();
        $recipe_data = $this->makeRecipeData($slot, $nextitem);
        foreach ($this->getLoader()->getRecipes() as $recipe)
        {
            if ($recipe->getRecipeData() == $recipe_data)
            {
                if ($recipe->getMode() == $this->getMode())
                {
                    $this->setResult($recipe->getResultItem());
                    return $transaction->continue();
                }
            }
        }
        $this->setResult(ItemFactory::getInstance()->get(0));
        return $transaction->continue();
    }

    public function MenuCloseListener(Player $player, Inventory $inventory)
    {
        for ($i = 0; $i <= 53; $i++)
        {
            if (!in_array($i, $this->getProtectedSlot()))
                if ($i !== $this->getResultSlot())
                {
                    $item = $inventory->getItem($i);
                    if ($item->getId() !== ItemIds::AIR)
                        $player->getInventory()->addItem($item);
                }
        }
    }

    public function makeRecipeData(int $slot, Item $nextitem): array
    {
        $recipe_data = [];
        for ($i = 0; $i <= 53; $i++)
        {
            if (!in_array($i, $this->getProtectedSlot()))
                if ($i !== $this->getResultSlot())
                {
                    if ($i == $slot)
                    {
                        array_push($recipe_data, $nextitem);
                    }
                    else
                    {
                        $item = $this->menu->getInventory()->getItem($i);
                        array_push($recipe_data, $item);
                    }
                }
        }
        return $recipe_data;
    }

    public function setResult(Item $item)
    {
        $this->menu->getInventory()->setItem($this->getResultSlot(), $item);
    }

    public function clearCraftItem()
    {
        for ($i = 0; $i <= 53; $i++)
        {
            if ((!in_array($i, $this->getProtectedSlot())) and ($i !== $this->getResultSlot()))
            {
                $this->menu->getInventory()->setItem($i, ItemFactory::getInstance()->get(ItemIds::AIR));
            }
        }
    }

    public function getResultSlot(): int
    {
        if ($this->getMode() == self::IIIxIII_MODE)
        {
            return self::IIIxIII_RESULT_SLOT;
        }
        return self::VIxVI_RESULT_SLOT;
    }

    public function getProtectedSlot(): array
    {
        if ($this->getMode() == self::IIIxIII_MODE)
        {
            return self::IIIxIII_PROTECTED_SLOT;
        }
        return self::VIxVI_PROTECTED_SLOT;
    }
}
