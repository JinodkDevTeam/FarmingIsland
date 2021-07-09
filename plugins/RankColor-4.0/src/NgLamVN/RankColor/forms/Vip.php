<?php

namespace NgLamVN\RankColor\forms;

class Vip extends BaseRankColor
{
    public function createColor(): void
    {
        foreach ($this->colors as $color)
        {
            $format = "§f|§l§".$color."VIP§r§f|";
            array_push($this->formats, $format);
        }
    }
}