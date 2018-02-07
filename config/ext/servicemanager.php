<?php
return array_merge_recursive(
    [
        'abstract_factories' =>
        [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        ***REMOVED***,
        'factories' => [
            'Zend\Db\Adapter\Adapter'          => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Gear\Module'                      => 'Gear\Module\ModuleServiceFactory',
            \Gear\Creator\FileCreator\FileCreator::class => \Gear\Creator\FileCreator\FileCreatorFactory::class,
            'Gear\Table\Metadata'              => 'Gear\Table\Metadata\MetadataFactory',
            'Gear\Table\Table'                 => 'Gear\Table\TableService\TableFactory',
        ***REMOVED***,
        'invokables' => [
            'Gear\Table\TableService'          => 'Gear\Table\TableService\TableService',
            'Gear\Creator\Code'                => 'Gear\Creator\Code',
            'Gear\Creator\CodeTest'            => 'Gear\Creator\CodeTest',
            'Gear\Creator\Controller'          => 'Gear\Creator\ControllerDependency',
            'Gear\Creator\App'                 => 'Gear\Creator\AppDependency',
            'Gear\Creator\Src'                 => 'Gear\Creator\SrcDependency',
            'Gear\Config\Config'               => 'Gear\Config\Service\ConfigService',
            'cacheService'                     => 'Gear\Cache\CacheService',
            'Gear\Autoload\Namespaces'         => 'Gear\Autoload\Namespaces',
            'SchemaListener'                   => 'Gear\Event\SchemaListener',
            'LogListener'                      => 'Gear\Event\LogListener',
            'Gear\Creator\Template'            => 'Gear\Creator\TemplateService',
            'consoleService'                   => 'Gear\Service\ConsoleService',
        ***REMOVED***,
        'aliases' => [
        	'Gear\Service\Mvc\ConfigService'   => 'configService',
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
