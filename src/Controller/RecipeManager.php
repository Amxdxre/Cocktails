<?php

namespace Cocktails\Controller;

use Cocktails\Entities\Cocktail;
use Cocktails\Entities\CocktailVariation;
use Cocktails\Entities\EntityItem;
use Cocktails\Entities\RecipeItem;
use Cocktails\Entities\Variation;
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

    public function addCocktailVariation($variation)
    {
        /** @var Variation $newVariation */
        $newVariation = Json::deserialize($variation, Variation::class);
        $lastVariation = count($this->getAllVariationsOfCocktail($newVariation->cocktailId)); // 8
        /**
         * @var EntityItem $ingredient
         * */
        foreach ($newVariation->ingredients as $ingredient) {
            $item = new Recipe();
            $item->setCocktailId($newVariation->cocktailId);
            $item->setVariation($lastVariation + 1); // 9
            $item->setIngredientId($ingredient->id);
            $item->setAmount($ingredient->amount);
            $item->setMeasure($ingredient->measure);
            $item->save();
        }
    }
    public function addItem($recipeItem)
    {
        // Возвращает $id записи.
        /** @var RecipeItem $rawItem */
        $rawItem = Json::deserialize($recipeItem, RecipeItem::class);
        $newItem = new Recipe();
        $newItem->setCocktailId($rawItem->cocktailId);
        $newItem->setVariation($rawItem->variation);
        $newItem->setIngredientId($rawItem->ingredientId);
        $newItem->setAmount($rawItem->amount);
        $newItem->setMeasure($rawItem->measure);
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