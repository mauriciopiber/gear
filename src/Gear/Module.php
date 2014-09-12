<?php
namespace Gear;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

class Module implements ConsoleUsageProviderInterface
{


    /**
     * This method is defined in ConsoleUsageProviderInterface
     */
    public function getConsoleUsage(Console $console)
    {
        return array(
            'gear -v'                                                                       => 'Shows the gear version',
            'gear create module <project> <path> <module>'                                  => 'Create a new module',
            'gear create crud <project> <path> <module> [<table_prefix>***REMOVED***'                   => 'Create full suite for all tables',
            'gear create entities <project> <path> <module> [<table_prefix>***REMOVED***'               => 'Create by doctrine all entities for project',
            'gear create project <project> <path>'                                          => 'Create a new skeleton app',
            'gear create file <project> <path> <module> <file> [<table>***REMOVED*** [<table_prefix>***REMOVED***'  => 'Create a new file from a specified format',
            'gear create lego <project> <path> <module> <piece> [<table>***REMOVED*** [<table_prefix>***REMOVED***' => 'Create a single piece of software',
            'gear create crud-unique <project> <path> <module> <table> [<table_prefix>***REMOVED*** [<exclude>***REMOVED***' => 'Create a full suite for a single table with exclude options'
        );
    }


    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getServiceConfig()
    {
         return array(
            'factories' => array(
                'tableRepository' => function ($serviceLocator) {
                    $tableRepository = new \Gear\Repository\TableRepository($serviceLocator->get('Zend\Db\Adapter\Adapter'));
                    return $tableRepository;
                },
                'moduleService' => 'Gear\Factory\ModuleServiceFactory',
                //'tableRepository' => 'Gear\Repository\Table'
                /*
                'schemaModel' => function ($serviceLocator) {
                    $schema = new \Gear\Model\Schema($serviceLocator->get('Zend\Db\Adapter\Adapter')->driver);
                    return $schema;
                },
                'tableService' => function ($serviceLocator) {
                    $table = new \Gear\Service\Table();
                    return $table;
                }*/
            ),
            'invokables' => array(
                'stringService'     => 'Gear\Service\Type\StringService',
                'dirWriterService'  => 'Gear\Service\Filesystem\DirWriterService',
                'fileWriterService' => 'Gear\Service\Filesystem\FileWriterService',
                'filesystemService' => 'Gear\Service\FilesystemService',
                'fileService' => 'Gear\Service\FileService',
                'tableService'  => 'Gear\Service\TableService',
                'specialityService'  => 'Gear\Service\SpecialityService',
                'module_gear'   => 'Gear\Model\ModuleGear',
                'database_gear' => 'Gear\Model\DatabaseGear',
                'sql_gear'      => 'Gear\Model\SqlGear',
                'power_gear'    => 'Gear\Model\PowerGear',
            ),

        );
    }
}