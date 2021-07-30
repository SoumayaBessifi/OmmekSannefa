<?php

namespace App\Enum;

abstract class Unit
{
    const types=[
        "g"=>"g",
        "Kg"=>"Kg",
        "ml"=>"ml",
        "L"=>"L",
        "piece"=>"piece",
        "Cup"=>"Cup",
        "Table Spoon"=>"Table Spoon",
        "Tea Spoon"=>"Tea Spoon",
        "Pinsh"=>"Pinsh"
    ];
    public static function getPossibleValues()
    {
        return self::types;
    }
}
?>