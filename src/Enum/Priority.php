<?php

namespace App\Enum;

abstract class Priority
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