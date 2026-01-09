<?php

namespace Cocktails\Entities;
use SamMcDonald\Json\Serializer\Attributes\JsonProperty;

class Ingredient
{
    #[JsonProperty]
    public int $id;
    #[JsonProperty]
    public string $name;
    #[JsonProperty]
    public string $description;
}