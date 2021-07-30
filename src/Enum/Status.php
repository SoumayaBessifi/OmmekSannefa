<?php

namespace App\Enum;

abstract class Status
{
    const types=[
        "Open"=>"Open",
        "Pending"=>"Pending",
        "In Progress"=>"InProgress",
        "Closed"=>"Closed"
    ];
    public static function getPossibleValues()
    {
        return self::types;
    }
}
?>