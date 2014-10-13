<?php
namespace Gear;

$consoleRoutes = require 'console.config.php';
$templateMap   = require 'templateMap.config.php';

return array(
    'url'     => 'modules.gear.dev',
    'version' => '0.1.0',
    'console' => $consoleRoutes,
    'controllers' => array(
        'invokables' => array(
            'Gear\Controller\Happy' => 'Gear\Controller\HappyController',
            'Gear\Controller\Db'    => 'Gear\Controller\DbController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'gear' => __DIR__ . '/../view',
        ),
        'template_map' => $templateMap
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
