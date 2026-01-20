<?php

namespace Cocktails\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Admin
{
    private Cocktails $cocktails;
    private Ingredients $ingredients;

    public function __construct()
    {
        $this->cocktails = new Cocktails();
        $this->ingredients = new Ingredients();
    }

    public function renderAdminPanel()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader, [
            'cache' => 'cache',
            'debug' => true
        ]);

        $cocktails = $this->cocktails->getList();
        $ingredients = $this->ingredients->getList();
        $template = $twig->load('adminPanel.twig');
        echo $template->render([
            'cocktails' => $cocktails,
            'ingredients' => $ingredients,
        ]);
    }
}