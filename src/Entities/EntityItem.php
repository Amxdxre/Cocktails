<?php

namespace Cocktails\Entities;

use SamMcDonald\Json\Serializer\Attributes\JsonProperty;

class EntityItem
{
    #[JsonProperty]
    public int $id;
    #[JsonProperty]
    public string $measure;
    #[JsonProperty]
    public int $amount;
    #[JsonProperty]
    public string $name;
}