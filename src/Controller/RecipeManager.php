<?php

namespace Cocktails\Controller;

use Recipe;
use RecipeQuery;

class RecipeManager
{
    public function getRecipeByCocktailId($cocktailId)
    {

    }

    public function getAllCocktailsByIngredient($ingredientId)
    {

    }

    public function getAllVariationsOfCocktail($cocktailId)
    {

    }

    public function addCocktailVariation($cocktailId)
    {
        //Принимает id коктейля, ищет максимальный индекс вариации, делает +1 и возвращает полученное число.
    }

    public function addItem($cocktailId, $ingredientId, $amount, $measure, $variation)
    {
        // Возвращает $id записи.
        
    }

    public function editItem($cocktailId, $ingredientId, $amount, $measure, $variation)
    {

    }

    public function deleteItem($variation)
    {
        RecipeQuery::create()->filterByVariation($variation)->delete();
    }
}