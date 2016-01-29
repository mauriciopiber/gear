<?php
namespace Gear;

$consoleRoutes   = require 'ext/console.route.php';
$consoleMessages = require 'ext/console.message.php';
$serviceManager  = require 'ext/servicemanager.php';
$speciality      = require 'speciality.types.php';

return array(
    'fileUpload' => array(
        'uploadDir' => __DIR__.'/../public/upload/',
        'refDir' => '/upload',
        'size' => array(
            'main' => array(
                'preview' => array('100', '100'),
                'a' => array('300', '300'),
                'b' => array('450', '450'),
                'c' => array('600', '600'),
             )
        )
    ),
    'console_messages' => $consoleMessages,

    'speciality' => $speciality,
    'service_manager' => $serviceManager,
    'gear' => array('version' => '0.2.18', 'acl' => true, 'name' => __NAMESPACE__),
    'console' => $consoleRoutes,
    'controllers' => array(
        'invokables' => array(
            'Gear\Controller\Happy' => 'Gear\Controller\HappyController',
        ),
        'factories' => array(
            'Gear\Controller\Module' => 'Gear\Module\Controller\ModuleControllerFactory',
            'Gear\Controller\Project' => 'Gear\Project\Controller\ProjectControllerFactory',
            'Gear\Controller\Constructor' => 'Gear\Constructor\Controller\ConstructorControllerFactory',
            'Gear\Controller\Config'      => 'Gear\Config\Controller\ConfigControllerFactory',
            'Gear\Controller\Db'      => 'Gear\Database\Controller\DbControllerFactory'

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
