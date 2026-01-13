<?php

namespace Cocktails\Controller;

use Cocktails\Interfaces\Provider;
use SamMcDonald\Json\Json;

class API
{
    public array $registredProviders = [];

    public function registerControllers()
    {
        $this->registredProviders = [
            'ingredient' => Ingredient::class,
            'cocktail' => CocktailController::class
        ];
    }

    public function __construct()
    {
        $this->registerControllers();
    }

    public function processPost($controller, $data)
    {
        list($entity, $provider) = $this->prepareRequestProcessing($controller, $data);
        $provider->post($entity);
    }

    public function processUpdate($controller, $data)
    {

    }

    /**
     * @param $controller
     * @return Provider
     */
    public function getProvider($controller): Provider
    {
        $providerClass = $this->registredProviders[$controller];
        if (empty($providerClass)) {
            http_response_code(500);
            die();
        }
        /** @var Provider $providerClass */
        $provider = new $providerClass;
        return $provider;
    }

    /**
     * @param $controller
     * @param $data
     * @return mixed
     */
    public function prepareRequestProcessing($controller, $data): mixed
    {
        $provider = $this->getProvider($controller);
        $entityClass = $provider->getAssociatedEntity();
        $entity = Json::deserialize($data, $entityClass);
        return [$entity, $provider];
    }
}