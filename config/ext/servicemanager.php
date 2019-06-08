<?php
return array_merge_recursive(
    [
        'abstract_factories' =>
        [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Gear\Mvc\Config\AbstractConfigManagerFactory',
            'Gear\Edge\AbstractEdgeFactory',
            'Gear\Mvc\AbstractMvcFactory',
            'Gear\Mvc\AbstractMvcTestFactory'
         ***REMOVED***,
        'factories' => [
            'Zend\Db\Adapter\Adapter'          => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Gear\Module'                      => 'Gear\Module\ModuleServiceFactory',
            'Gear\Module\ModuleService'        => 'Gear\Module\ModuleServiceFactory',
            \Gear\Creator\FileCreator\FileCreator::class => \Gear\Creator\FileCreator\FileCreatorFactory::class,
            'Gear\Table\Metadata'              => 'Gear\Table\Metadata\MetadataFactory',
            'Gear\Table\Table'                 => 'Gear\Table\TableService\TableFactory',
            'Gear\Creator\Template\TemplateService'  => 'Gear\Creator\Template\TemplateServiceFactory',
        ***REMOVED***,
        'invokables' => [
            'Gear\Table\TableService'          => 'Gear\Table\TableService\TableService',
            'Gear\Creator\Code'                => 'Gear\Creator\Code',
            'Gear\Creator\CodeTest'            => 'Gear\Creator\CodeTest',
            'Gear\Creator\Controller'          => 'Gear\Creator\ControllerDependency',
            'Gear\Creator\App'                 => 'Gear\Creator\AppDependency',
            'Gear\Creator\Src'                 => 'Gear\Creator\SrcDependency',
            'cacheService'                     => 'Gear\Cache\CacheService',
            'Gear\Autoload\Namespaces'         => 'Gear\Autoload\Namespaces',
            'SchemaListener'                   => 'Gear\Event\SchemaListener',
            'LogListener'                      => 'Gear\Event\LogListener',
            'consoleService'                   => 'Gear\Service\ConsoleService',
        ***REMOVED***,
        'aliases' => [
            'dirService'                       => 'GearBase\Util\Dir',
            'fileService'                      => 'GearBase\Util\File',
            'stringService'                    => 'GearBase\Util\String'
        ***REMOVED***,
        'shared' => [
    	    \Gear\Creator\FileCreator\FileCreator::class                 => false,
            'Gear\Autoload\Namespaces'         => false,
        ***REMOVED***,
    ***REMOVED***,
    require __DIR__.'/servicemanager/mvc.php',
    require __DIR__.'/servicemanager/constructor.php',
    require __DIR__.'/servicemanager/module.php',
    require __DIR__.'/servicemanager/database.php',
    require __DIR__.'/servicemanager/project.php',
    require __DIR__.'/servicemanager.config.php'
);
