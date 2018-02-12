<?php
namespace Gear;

$consoleRoutes   = require 'ext/console.route.php';
$consoleMessages = require 'ext/console.message.php';
$serviceManager  = require 'ext/servicemanager.php';
$speciality      = require 'speciality.types.php';
$view = require 'view.config.php';

return [
    'caches' => [
        'memcached' => array( //can be called directly via SM in the name of 'memcached'
            'adapter' => array(
                'name'     =>'memcached',
                'lifetime' => 7200,
                'options'  => array(
                    'servers'   => array(
                        array(
                            '127.0.0.1', 11211
                        )
                    ),
                    'namespace'  => 'GEARCREATOR',
                    'liboptions' => array (
                        'COMPRESSION' => true,
                        'binary_protocol' => true,
                        'no_block' => true,
                        'connect_timeout' => 100
                    )
                )
            ),
            'plugins' => array(
                'exception_handler' => array(
                    'throw_exceptions' => false
                ),
            ),
        ),
    ***REMOVED***,
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
        'modules' => [
            'gear' => [
                'version' => '0.2.130',
                'acl' => true,
                'name' => __NAMESPACE__,
                'git' => 'git@bitbucket.org:mauriciopiber/gear.git',
                'type' => 'cli'
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***,
    'console' => $consoleRoutes,
    'controllers' => [
        'invokables' => [
            'Gear\Constructor\Db'         => 'Gear\Constructor\Db\DbController',
            'Gear\Constructor\App\AppController' => 'Gear\Constructor\App\AppController',
        ***REMOVED***,
        'factories' => [
            'Gear\Module\Constructor\Src'        => 'Gear\Constructor\Src\SrcControllerFactory',
            'Gear\Module\Constructor\Controller' => 'Gear\Constructor\Controller\ControllerControllerFactory',
            'Gear\Module\Constructor\Action'     => 'Gear\Constructor\Action\ActionControllerFactory',
            'Gear\Module\Constructor\Db'         => 'Gear\Constructor\Db\DbControllerFactory',
            'Gear\Module\Constructor\View'       => 'Gear\Constructor\View\ViewControllerFactory',
            'Gear\Module\Constructor\Test'       => 'Gear\Constructor\Test\TestControllerFactory',
            'Gear\Module'                        => 'Gear\Module\Controller\ModuleControllerFactory',
            'Gear\Controller\Project'            => 'Gear\Project\Controller\ProjectControllerFactory',
            'Gear\Controller\Config'             => 'Gear\Config\Controller\ConfigControllerFactory',
            'Gear\Controller\Db'                 => 'Gear\Database\Controller\DbControllerFactory'
        ***REMOVED***,
    ***REMOVED***,
    'view_manager' => $view,
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
    ***REMOVED***
***REMOVED***;
