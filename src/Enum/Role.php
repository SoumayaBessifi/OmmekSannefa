<?php

namespace App\Enum;

abstract class Role
{
    const types=[
        "Administrator"=>"admin",
        "user"=>"user"
    ];
    public static function getPossibleValues()
    {
        return self::types;
    }
}
?>