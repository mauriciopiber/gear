<?php
namespace Gear;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Gear\Common\DirWriterAwareInterface;

class Module implements ConsoleUsageProviderInterface
{


    /**
     * This method is defined in ConsoleUsageProviderInterface
     */
    public function getConsoleUsage(Console $console)
    {
        return array(
            'gear -v'                                                                       => 'Shows the gear version',
            'gear module create <module>'                                                   => 'Create a new basic module with IndexAction',
            'gear module remove <module>'                                                   => 'Removes full module',
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
             'initializers' => array(
                 'dirServiceAwareInterface' => function($model, $serviceLocator) {
                     if($model instanceof DirServiceAwareInterface) {
                         $dirWriter = $serviceLocator->get('dirService');
                         $model->setDirService($dirWriter);
                     }
                 }
             ),
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
                //services
                'moduleTestService' => 'Gear\Service\Module\ModuleTestService',
                'classService'   => 'Gear\Service\Filesystem\ClassService',
                'dirService'     => 'Gear\Service\Filesystem\DirService',
                'fileService'    => 'Gear\Service\Filesystem\FileService',
                'stringService'  => 'Gear\Service\Type\StringService',
                'moduleFileService' => 'Gear\Service\Module\ModuleFileService',
                'filesystemService' => 'Gear\Service\FilesystemService',
                'tableService'  => 'Gear\Service\TableService',
                'specialityService'  => 'Gear\Service\SpecialityService',
                'module_gear'   => 'Gear\Model\ModuleGear',
                'database_gear' => 'Gear\Model\DatabaseGear',
                'sql_gear'      => 'Gear\Model\SqlGear',
                'power_gear'    => 'Gear\Model\PowerGear',
            )
        );
    }
}