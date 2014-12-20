<?php
namespace Gear;

$consoleRoutes  = require 'console.config.php';
$templateMap    = require 'templateMap.config.php';
$serviceManager = require 'serviceManager.config.php';

return array(
    'controller_plugins' => array(
        'factories' => array(
            'Gear' => 'Gear\Controller\Plugin\GearFactory',
        )
    ),
    'service_manager' => $serviceManager,
    'acl'     => array('Gear' => true),
    'url'     => 'modules.gear.dev',
    'version' => '0.1.26',
    'console' => $consoleRoutes,
    'controllers' => array(
        'invokables' => array(
            'Gear\Controller\Happy' => 'Gear\Controller\HappyController',
        ),
        'factories' => array(
            'Gear\Controller\Index' => 'Gear\Factory\IndexControllerFactory',
            'Gear\Controller\Gear'  => 'Gear\Factory\GearControllerFactory',
            'Gear\Controller\Module' => 'Gear\Factory\ModuleControllerFactory',
            'Gear\Controller\Project' => 'Gear\Factory\ProjectControllerFactory',
            'Gear\Controller\Constructor' => 'Gear\Factory\ConstructorControllerFactory',
            'Gear\Controller\Build'      => 'Gear\Factory\BuildControllerFactory'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'gear' => __DIR__ . '/../view',
            'template' => __DIR__ . '/../view',
        ),
        'template_map' => $templateMap,
        'factories' => array(
            'arrayToYml' => 'Gear\Factory\ArrayToYmlHelperFactory',
            'str' => 'Gear\Factory\StrHelperFactory'
        )
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'configuration' => 'orm_default',
                'eventmanager' => 'orm_default',
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'dbname' => 'zf2-module-security',
                    'charset' => 'utf8'
                )
            )
        ),
        'driver' => array(
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            ),
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                )
            )
        )
    ),
);
