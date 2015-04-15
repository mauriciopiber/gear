<?php
namespace Gear;

$consoleRoutes   = require 'console.config.php';
$consoleMessages = require 'console.message.config.php';
$serviceManager  = require 'serviceManager.config.php';
$speciality      = require 'speciality.types.php';

return array(
    'console_messages' => $consoleMessages,
    'controller_plugins' => array(
        'factories' => array(
            'Gear' => 'Gear\Controller\Plugin\GearFactory',
        )
    ),
    'speciality' => $speciality,
    'service_manager' => $serviceManager,
    'gear' => array('version' => '0.1.51', 'acl' => true, 'name' => __NAMESPACE__),
    'acl'     => array('Gear' => true),
    'url'     => 'modules.gear.dev',
    'version' => '0.1.51',
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
            'Gear\Controller\Build'      => 'Gear\Factory\BuildControllerFactory',
            'Gear\Controller\Db'      => 'Gear\Factory\DbControllerFactory'

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'gear' => __DIR__ . '/../view',
            'template' => __DIR__ . '/../view',
        ),

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
        ),

    )
);
