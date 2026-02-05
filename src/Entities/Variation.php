<?php

namespace Cocktails\Entities;

use SamMcDonald\Json\Serializer\Attributes\JsonProperty;

class Variation
{
//    #[JsonProperty('ingredients')]
//    public function setIngredients($ingredient) {
//     var_dump($ingredient);
//    }
    #[JsonProperty]
    public int $cocktailId;
    #[JsonProperty]
    public string $cocktail;
    #[JsonProperty]
    public array $ingredients = [];
    #[JsonProperty]
    public array $methods = [];
}