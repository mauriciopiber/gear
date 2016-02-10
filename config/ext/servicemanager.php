<?php
return array_merge_recursive(array(
    'initializers' => array(
        'Gear\Initializer\DirInitializer',
        'Gear\Initializer\ClassInitializer',
        'Gear\Initializer\ModuleInitializer',
        'Gear\Initializer\TemplateInitializer'
    ),
    'factories' => array(
        'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        'moduleService'   => 'Gear\Factory\ModuleServiceFactory',
        'Gear\Schema'         => 'Gear\Factory\SchemaFactory',
        'Gear\Factory\Metadata' => 'Gear\Factory\MetadataFactory',
        'fileCreatorFactory' => 'Gear\Factory\FileCreatorFactory'
    ),
    'invokables' => array(

        'cacheService'              => 'Gear\Cache\CacheService',

        'Gear\Autoload\Namespaces'    => 'Gear\Autoload\Namespaces',




        'SchemaListener' => 'Gear\Event\SchemaListener',
        'LogListener' => 'Gear\Event\LogListener',

        'Gear\Creator\Template'       => 'Gear\Creator\TemplateService',



        'classService'              => 'Gear\Service\Type\ClassService',




        'consoleService'            => 'Gear\Service\ConsoleService',

    ),
    'aliases' => array(
    	'Gear\Service\Mvc\ConfigService' => 'configService',

        'dirService'                => 'GearBase\Util\Dir',
        'fileService'               => 'GearBase\Util\File',
        'stringService'             => 'GearBase\Util\String',

        'fileCreator' => 'fileCreatorFactory'
    ),
    'shared' => array(
	    'fileCreatorFactory' => false,
        'Gear\Autoload\Namespaces' => false,
    ),
),
    require __DIR__.'/servicemanager/mvc.php',
    require __DIR__.'/servicemanager/constructor.php',
    require __DIR__.'/servicemanager/module.php',
    require __DIR__.'/servicemanager/database.php',
    require __DIR__.'/servicemanager/project.php',
    require __DIR__.'/servicemanager.config.php'
);
