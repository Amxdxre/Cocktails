<?php

namespace Cocktails;

use Cocktails\Entities\Ingredient;
use Ingredients;
use IngredientsQuery;
use SamMcDonald\Json\Json;

class IngredientController
{
    public function getAll()
    {
        $ingredients = [];
        $collection = IngredientsQuery::create()->find();
        foreach ($collection as $item) {
            $ingredient = new Ingredient();
            $ingredient->id = $item->getId();
            $ingredient->name = $item->getName();
            $ingredient->description = $item->getDescription();
            $ingredients[] = $ingredient;
        }
        echo json_encode($ingredients);
    }
    public function get($id)
    {
        $query = new IngredientsQuery();
        $ingredientDB = $query->findPk($id);
        $ingredient = new Ingredient();
        $ingredient->id = $ingredientDB->getId();
        $ingredient->name = $ingredientDB->getName();
        $ingredient->description = $ingredientDB->getDescription();
        echo Json::serialize($ingredient);
    }
    public function post($data)
    {
        /** @var Ingredient $ingredientData */
        $ingredientData = Json::deserialize($data, Ingredient::class);
        $ingredients = new Ingredients();
        $ingredients->setName($ingredientData->name);
        $ingredients->setDescription($ingredientData->description);
        $ingredients->save();
        $ingredient = new Ingredient();
        $ingredient->name = $ingredients->getName();
        $ingredient->description = $ingredients->getDescription();
        echo Json::serialize($ingredient);
    }
    public function update($data)
    {
        /** @var Ingredient $ingredientData */
        $ingredientData = Json::deserialize($data, Ingredient::class);
        $query = new IngredientsQuery();
        $selectedIngredient = $query->findPk($ingredientData->id);
        if ($selectedIngredient->getId() === $ingredientData->id) {
            $selectedIngredient->setName($ingredientData->name);
            $selectedIngredient->setDescription($ingredientData->description);
        }
        $ingredient = new Ingredient();
        $ingredient->id = $selectedIngredient->getId();
        $ingredient->name = $selectedIngredient->getName();
        $ingredient->description = $selectedIngredient->getDescription();
        echo Json::serialize($ingredient);
    }
    public function delete($id)
    {
        IngredientsQuery::create()->filterById($id)->delete();
    }
}