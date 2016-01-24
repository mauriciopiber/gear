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
    'gear' => array('version' => '0.2.14', 'acl' => true, 'name' => __NAMESPACE__),
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
            'Gear\Controller\Constructor' => 'Gear\Constructor\Factory\ConstructorControllerFactory',
            'Gear\Controller\Config'      => 'Gear\Factory\ConfigControllerFactory',
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
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=gear;host=localhost',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
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
                    'dbname' => 'gear',
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
