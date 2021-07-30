<?php

namespace App\Enum;

abstract class ClaimCategory
{
    const types=[
        "Technical"=>"Technical",
        "Comunity"=>"Comunity",
        "Support"=>"Support",
        "Suggestion"=>"Suggestion",
    ];
    public static function getPossibleKeyValues()
    {
        return self::types;
    }
}
?>