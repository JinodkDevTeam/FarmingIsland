<?php

namespace NgLamVN\RankColor\forms;

class Staff extends BaseRankColor
{
    public function createColor(): void
    {
        foreach ($this->colors as $color)
        {
            $format = "§f|§l§".$color."Staff§r§f|";
            array_push($this->formats, $format);
        }
    }
}
