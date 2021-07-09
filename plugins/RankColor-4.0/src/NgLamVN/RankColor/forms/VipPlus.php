<?php

namespace NgLamVN\RankColor\forms;

class VipPlus extends BaseRankColor
{
    public function createColor(): void
    {
        foreach ($this->colors as $color)
        {
            foreach ($this->colors as $color2)
            {
                $format = "§f|§l§" . $color . "VIP§" . $color2 . "+§r§f|";
                array_push($this->formats, $format);
            }
        }
    }
}