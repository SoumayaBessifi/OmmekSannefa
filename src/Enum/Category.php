<?php

namespace App\Enum;

abstract class Category
{
    const types=[
        "Entree cource"=>"Entreecource",
        "Main dish"=>"Maindish",
        "Side Dish"=>"SideDish",
        "Dessert"=>"Dessert",
        "Drink"=>"Drink",
        "Other"=>"Other",
    ];
    public static function getPossibleValues()
    {
        return self::types;
    }
}
?>