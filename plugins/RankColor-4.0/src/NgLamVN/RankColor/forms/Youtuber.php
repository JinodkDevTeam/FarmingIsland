<?php

namespace NgLamVN\RankColor\forms;

class Youtuber extends BaseRankColor
{
    public function createColor(): void
    {
        foreach ($this->colors as $color)
        {
            foreach ($this->colors as $color2)
            {
                $format = "§f|§l§" . $color . "You§" . $color2 . "tuber§r§f|";
                array_push($this->formats, $format);
            }
        }
    }
}