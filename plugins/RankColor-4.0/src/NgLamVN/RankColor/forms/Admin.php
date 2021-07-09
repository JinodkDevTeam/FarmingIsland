<?php

namespace NgLamVN\RankColor\forms;

class Admin extends BaseRankColor
{
    public function createColor(): void
    {
        foreach ($this->colors as $color)
        {
            $format = "§f|§l§".$color."Admin§r§f|";
            array_push($this->formats, $format);
        }
    }
}
