<?php

namespace App\Enum;

abstract class Difficulty
{
    const types=[
        "Low"=>"Low",
        "Medium"=>"Medium",
        "High"=>"High",
    ];
    public static function getPossibleValues()
    {
        return self::types;
    }
}
?>