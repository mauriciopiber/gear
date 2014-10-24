<?php
namespace Gear;

$consoleRoutes = require 'console.config.php';
$templateMap   = require 'templateMap.config.php';

return array(
    'service_manager' => array(
        'invokables' => array(
            'SchemaListener' => 'Gear\Event\SchemaListener',
            'LogListener' => 'Gear\Event\LogListener'
        ),
    ),
    'acl'     => array('Gear' => true),
    'url'     => 'modules.gear.dev',
    'version' => '0.1.2',
    'console' => $consoleRoutes,
    'controllers' => array(
        'invokables' => array(
            'Gear\Controller\Happy' => 'Gear\Controller\HappyController',
        ),
        'factories' => array(
            'Gear\Controller\Index' => function($controllerManager) {

                $indexController = new \Gear\Controller\IndexController();

                $serviceLocator = $controllerManager->getServiceLocator();

                $eventManager = $serviceLocator->get('eventManager');

                $application = $serviceLocator->get('application');

                return $indexController;
            }
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'gear' => __DIR__ . '/../view',
            'template' => __DIR__ . '/../view',
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
