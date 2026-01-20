<?php

namespace Cocktails\Controller;

use Cocktails\Entities\Ingredient;
use Cocktails\Interfaces\Provider;
use Ingredients as IngredientsDTO;
use IngredientsQuery;
use SamMcDonald\Json\Json;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Ingredients implements Provider
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
        return $ingredients;
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
    public function post($entity)
    {
        $ingredients = new IngredientsDTO();
        $ingredients->setName($entity->name);
        $ingredients->setDescription($entity->description);
        $id = $ingredients->save();
        $ingredient = new Ingredient();
        $ingredient->id = $id;
        $ingredient->name = $ingredients->getName();
        $ingredient->description = $ingredients->getDescription();
        echo Json::serialize($ingredient);
    }
    public function update($entity)
    {
        $query = new IngredientsQuery();
        $selectedIngredient = $query->findPk($entity->id);
        if ($selectedIngredient->getId() === $entity->id) {
            $selectedIngredient->setName($entity->name);
            $selectedIngredient->setDescription($entity->description);
            $selectedIngredient->save();
        }
        $ingredient = new Ingredient();
        $ingredient->id = $selectedIngredient->getId();
        $ingredient->name = $selectedIngredient->getName();
        $ingredient->description = $selectedIngredient->getDescription();
        echo Json::serialize($ingredient);
    }
    public function delete($entity)
    {
        $removeIngredient = IngredientsQuery::create()->filterById($entity->id)->delete();
        if ($removeIngredient) {
            $log = ['success' => true];
        } else {
            $log = ['success' => false];
            http_response_code(404);
        }
        echo json_encode($log);
    }

    public function getAssociatedEntity()
    {
        return Ingredient::class;
    }
}