<?php

namespace Cocktails\Entities;

use SamMcDonald\Json\Serializer\Attributes\JsonProperty;

class RecipeItem
{
    #[JsonProperty]
    public int $itemId;
    #[JsonProperty]
    public int $cocktailId;
    #[JsonProperty]
    public int $ingredientId;
    #[JsonProperty]
    public int $variation;
    #[JsonProperty]
    public int $amount;
    #[JsonProperty]
    public string $measure;
}