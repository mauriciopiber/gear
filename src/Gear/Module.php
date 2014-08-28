<?php
namespace Gear;

class Module
{
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
                }
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