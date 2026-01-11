<?php

namespace Cocktails;

use Cocktails\Entities\Ingredient;
use Ingredients;
use IngredientsQuery;
use SamMcDonald\Json\Json;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class IngredientController
{
    public int $size = 20;
    public function renderPage()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader, [
            'cache' => 'cache',
            'debug' => true
        ]);
        $ingredients = $this->getList();
        $template = $twig->load('ingredients.twig');
        echo $template->render([
            'ingredients' => $ingredients,
            'size' => $this->size
        ]);
    }

    public function getList()
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