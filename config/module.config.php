<?php
namespace Gear;

$consoleRoutes   = require 'ext/console.route.php';
$consoleMessages = require 'ext/console.message.php';
$serviceManager  = require 'ext/servicemanager.php';
$speciality      = require 'speciality.types.php';

return [
    'fileUpload' => [
        'uploadDir' => __DIR__.'/../public/upload/',
        'refDir' => '/upload',
        'size' => [
            'main' => [
                'preview' => ['100', '100'***REMOVED***,
                'a' => ['300', '300'***REMOVED***,
                'b' => ['450', '450'***REMOVED***,
                'c' => ['600', '600'***REMOVED***,
             ***REMOVED***
        ***REMOVED***
    ***REMOVED***,
    'console_messages' => $consoleMessages,

    'speciality' => $speciality,
    'service_manager' => $serviceManager,
    'gear' => [
        'version' => '0.2.22',
        'acl' => true,
        'name' => __NAMESPACE__,
    ***REMOVED***,
    'console' => $consoleRoutes,
    'controllers' => [
        'invokables' => [
            'Gear\Controller\Happy' => 'Gear\Controller\HappyController',
        ***REMOVED***,
        'factories' => [
            'Gear\Controller\Module' => 'Gear\Module\Controller\ModuleControllerFactory',
            'Gear\Controller\Project' => 'Gear\Project\Controller\ProjectControllerFactory',
            'Gear\Controller\Constructor' => 'Gear\Constructor\Controller\ConstructorControllerFactory',
            'Gear\Controller\Config'      => 'Gear\Config\Controller\ConfigControllerFactory',
            'Gear\Controller\Db'      => 'Gear\Database\Controller\DbControllerFactory'

        ***REMOVED***,
    ***REMOVED***,
    'view_manager' => [
        'template_path_stack' => [
            'gear' => __DIR__ . '/../view',
            'template' => __DIR__ . '/../view',
        ***REMOVED***,

        'factories' => [
            'arrayToYml' => 'Gear\Factory\ArrayToYmlHelperFactory',
            'str' => 'Gear\Factory\StrHelperFactory'
        ***REMOVED***
    ***REMOVED***,
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=gear;host=localhost',
        'driver_options' => [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ***REMOVED***
    ***REMOVED***,
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'configuration' => 'orm_default',
                'eventmanager' => 'orm_default',
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'dbname' => 'gear',
                    'charset' => 'utf8'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'driver' => [
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ***REMOVED***
            ***REMOVED***,
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => [
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,

    ***REMOVED***
***REMOVED***;
