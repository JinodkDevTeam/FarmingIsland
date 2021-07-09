<?php

namespace NgLamVN\RankColor\forms;

class Member extends BaseRankColor
{
    public function createColor(): void
    {
        foreach ($this->colors as $color)
        {
            $format = "§f|§l§".$color."Member§r§f|";
            array_push($this->formats, $format);
        }
    }
}
