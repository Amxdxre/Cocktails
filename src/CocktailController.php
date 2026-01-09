<?php

namespace Cocktails;
use Cocktails;
use Cocktails\Entities\Cocktail;
use CocktailsQuery;
use SamMcDonald\Json\Json;

class CocktailController
{
    public function getAll()
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
        echo json_encode($cocktails);
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
    public function post($data)
    {
        /** @var Cocktail $cocktailData */
        $cocktailData = Json::deserialize($data, Cocktail::class);
        $cocktails = new Cocktails();
        $cocktails->setName($cocktailData->name);
        $cocktails->setDescription($cocktailData->description);
        $cocktails->save();
        $cocktail = new Cocktail();
        $cocktail->name = $cocktails->getName();
        $cocktail->description = $cocktails->getDescription();
        echo Json::serialize($cocktail);
    }
    public function update($data)
    {
        /** @var Cocktail $cocktailData */
        $cocktailData = Json::deserialize($data, Cocktail::class);
        $query = new CocktailsQuery();
        $selectedCocktail = $query->findPk($cocktailData->id);
        if ($selectedCocktail->getId() === $cocktailData->id) {
            $selectedCocktail->setName($cocktailData->name);
            $selectedCocktail->setDescription($cocktailData->description);
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
}