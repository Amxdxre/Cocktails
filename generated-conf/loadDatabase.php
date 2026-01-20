<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'cocktails' => 
  array (
    'tablesByName' => 
    array (
      'cocktails' => '\\Map\\CocktailsTableMap',
      'ingredients' => '\\Map\\IngredientsTableMap',
      'recipe' => '\\Map\\RecipeTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Cocktails' => '\\Map\\CocktailsTableMap',
      '\\Ingredients' => '\\Map\\IngredientsTableMap',
      '\\Recipe' => '\\Map\\RecipeTableMap',
    ),
  ),
));
