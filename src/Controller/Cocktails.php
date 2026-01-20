<?php

namespace Cocktails\Controller;
use Cocktails as CocktailsDTO;
use Cocktails\Entities\Cocktail;
use Cocktails\Interfaces\Provider;
use CocktailsQuery;
use SamMcDonald\Json\Json;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Cocktails implements Provider
{
    public int $size = 20;

    public function renderPage()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader, [
            'cache' => 'cache',
            'debug' => true
        ]);
        $cocktails = $this->getList();
        $template = $twig->load('cocktails.twig');
        echo $template->render([
            'cocktails' => $cocktails,
            'size' => $this->size
        ]);
    }

    public function getList()
    {
        $cocktails = [];
        $collection = CocktailsQuery::create()->find();
        foreach ($collection as $item) {
            $cocktail = new Cocktail();
            $cocktail->id = $item->getId();
            $cocktail->name = $item->getName();
            $cocktail->description = $item->getDescription();
            $cocktails[] = $cocktail;
        }
        return $cocktails;
    }
    public function get($id)
    {
        $query = new CocktailsQuery();
        $cocktailDB = $query->findPk($id);
        $cocktail = new Cocktail();
        $cocktail->id = $cocktailDB->getId();
        $cocktail->name = $cocktailDB->getName();
        $cocktail->description = $cocktailDB->getDescription();
        echo Json::serialize($cocktail);
    }
    public function post($entity)
    {
        $cocktails = new CocktailsDTO();
        $cocktails->setName($entity->name);
        $cocktails->setDescription($entity->description);
        $id = $cocktails->save();
        $cocktail = new Cocktail();
        $cocktail->id = $id;
        $cocktail->name = $cocktails->getName();
        $cocktail->description = $cocktails->getDescription();
        echo Json::serialize($cocktail);
    }
    public function update($entity)
    {
        $query = new CocktailsQuery();
        $selectedCocktail = $query->findPk($entity->id);
        if ($selectedCocktail->getId() === $entity->id) {
            $selectedCocktail->setName($entity->name);
            $selectedCocktail->setDescription($entity->description);
            $selectedCocktail->save();
        }
        $cocktail = new Cocktail();
        $cocktail->id = $selectedCocktail->getId();
        $cocktail->name = $selectedCocktail->getName();
        $cocktail->description = $selectedCocktail->getDescription();
        echo Json::serialize($cocktail);

    }
    public function delete($id)
    {
        CocktailsQuery::create()->filterById($id)->delete();
    }

    public function getAssociatedEntity()
    {
        return Cocktail::class;
    }

}