<?php

namespace Cocktails\Controller;

use Cocktails\Entities\Cocktail;
use Cocktails\Entities\CocktailVariation;
use Cocktails\Entities\RecipeItem;
use Recipe;
use RecipeQuery;
use SamMcDonald\Json\Json;

class RecipeManager
{
    public function getRecipesByCocktailId($cocktailId)
    {
        $collection = RecipeQuery::create()->filterByCocktailId($cocktailId)->find();
        $recipes = [];
        foreach ($collection as $item) {
            $recipe = new RecipeItem();
            $recipe->itemId = $item->getItemId();
            $recipe->cocktailId = $item->getCocktailId();
            $recipe->ingredientId = $item->getIngredientId();
            $recipe->amount = $item->getAmount();
            $recipe->measure = $item->getMeasure();
            $recipe->variation = $item->getVariation();
            $recipes[] = $recipe;
        }
        return $recipes;
    }

    public function getAllCocktailsByIngredient($ingredientId)
    {
        $collection = RecipeQuery::create()->filterByIngredientId($ingredientId)->find();
        $cocktails = [];
        foreach ($collection as $item) {
            $recipeItem = new RecipeItem();
            $recipeItem->cocktailId = $item->getCocktailId();
            $recipeItem->ingredientId = $item->getIngredientId();
            $cocktails[] = $recipeItem;
        }
        return $cocktails;
    }

    public function getAllVariationsOfCocktail($cocktailId)
    {
        $collection = RecipeQuery::create()->filterByCocktailId($cocktailId)->find();
        $variations = [];
        foreach ($collection as $variation) {
            $cocktailVariation = new RecipeItem();
            $cocktailVariation->cocktailId = $variation->getCocktailId();
            $cocktailVariation->variation = $variation->getVariation();
            $variations[] = $cocktailVariation;
        }
        return $variations;
    }

    public function addCocktailVariation($cocktailId)
    {
        //Принимает id коктейля, ищет максимальный индекс вариации, делает +1 и возвращает полученное число.
        $query = RecipeQuery::create()->filterByCocktailId($cocktailId);
        $lastVariation = $query->select('variation')->find()->getLast();
        $recipe = new Recipe();
        $recipe->setCocktailId($cocktailId);
        $recipe->setVariation($lastVariation + 1);
        $recipe->save();
        $item = new RecipeItem();
        $item->itemId = $recipe->getCocktailId();
        $item->itemId = $recipe->getVariation();
        echo Json::serialize($item);
    }

    public function addItem($recipeItem)
    {
        // Возвращает $id записи.
        /** @var RecipeItem $rawItem */
        $rawItem = Json::deserialize($recipeItem, RecipeItem::class);
        $newItem = new Recipe();
        $newItem->setCocktailId($rawItem->cocktailId);
        $newItem->setIngredientId($rawItem->ingredientId);
        $newItem->setAmount($rawItem->amount);
        $newItem->setMeasure($rawItem->measure);
        $newItem->setVariation($rawItem->variation);
        $newItem->save();
        $item = new RecipeItem();
        $item->itemId = $newItem->getItemId();
        echo Json::serialize($item);
    }

    public function editItem($recipeItem)
    {
        /** @var RecipeItem $rawItem */
        $rawItem = Json::deserialize($recipeItem, RecipeItem::class);
        $query = RecipeQuery::create()->filterByCocktailId($rawItem->cocktailId);
        $item = $query->filterByVariation($rawItem->variation);
        $currentItem = $item->findPk($rawItem->itemId);
        $currentItem->setAmount($rawItem->amount);
        $currentItem->setMeasure($rawItem->measure);
        $currentItem->save();
    }

    public function deleteItem($recipeItem)
    {
        /** @var RecipeItem $rawItem */
        $rawItem = Json::deserialize($recipeItem, RecipeItem::class);
        $query = RecipeQuery::create()->filterByCocktailId($rawItem->cocktailId);
        $item = $query->filterByVariation($rawItem->variation);
        $item->findPk($rawItem->itemId)->delete();
    }
}