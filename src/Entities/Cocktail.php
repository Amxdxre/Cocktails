<?php

namespace Cocktails\Entities;
use SamMcDonald\Json\Serializer\Attributes\JsonProperty;

class Cocktail
{
    #[JsonProperty]
    public int $id;
    #[JsonProperty]
    public string $name;
    #[JsonProperty]
    public string $description;
}