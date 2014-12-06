<?php
namespace PiberNetwork;

$env = getenv('APP_ENV');

if (in_array($env, array('development', 'production', 'staging', 'testing'))) {
    $db                 = require sprintf('ext/db.%s.config.php', $env);
    $doctrine           = require sprintf('ext/doctrine.%s.config.php', $env);
} else {
    $db                 = require sprintf('ext/db.development.config.php', $env);
    $doctrine           = require sprintf('ext/doctrine.development.config.php', $env);
}

$translator         = require 'ext/translator.config.php';
$route              = require 'ext/route.config.php';
$navigation         = require 'ext/navigation.config.php';
$view               = require 'ext/view.config.php';
$servicemanager     = require 'ext/servicemanager.config.php';
$controller         = require 'ext/controller.config.php';
$assetmanager       = require 'ext/asset.config.php';
$controllerplugins  = require 'ext/controllerplugins.config.php';

return array(
    'acl'     => array('PiberNetwork' => true),
    'db' => $db,
    'doctrine' => $doctrine,
    'translator' => $translator,
    'view_manager' => $view,
    'controllers' => $controller,
    'router' => $route,
    'navigation' => $navigation,
    'service_manager' => $servicemanager,
    'asset_manager' => $assetmanager,
    'controller_plugins' => $controllerplugins
);
