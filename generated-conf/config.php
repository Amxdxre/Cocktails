<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('cocktails', 'sqlite');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle('cocktails');
$manager->setConfiguration(array (
  'dsn' => 'sqlite:db/cocktails.sq3',
  'user' => 'amadare',
  'password' => 'amadare',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$serviceContainer->setConnectionManager($manager);
$serviceContainer->setDefaultDatasource('cocktails');
require_once __DIR__ . '/./loadDatabase.php';
