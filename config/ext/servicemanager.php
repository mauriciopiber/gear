<?php
return array_merge_recursive(
    array(
        'initializers' => array(
            'Gear\Initializer\DirInitializer',

            'Gear\Initializer\ModuleInitializer',
            'Gear\Initializer\TemplateInitializer'
        ),
        'factories' => array(
            'Zend\Db\Adapter\Adapter'          => 'Zend\Db\Adapter\AdapterServiceFactory',
            'moduleService'                    => 'Gear\Module\ModuleServiceFactory',
            'Gear\Factory\Metadata'            => 'Gear\Metadata\MetadataFactory',
            'fileCreatorFactory'               => 'Gear\Creator\FileCreatorFactory',
            'Gear\Metadata\Table'              => 'Gear\Metadata\TableFactory'
        ),
        'invokables' => array(
            'Gear\Creator\Code'                => 'Gear\Creator\Code',
            'Gear\Creator\CodeTest'            => 'Gear\Creator\CodeTest',
            'cacheService'                     => 'Gear\Cache\CacheService',
            'Gear\Autoload\Namespaces'         => 'Gear\Autoload\Namespaces',
            'SchemaListener'                   => 'Gear\Event\SchemaListener',
            'LogListener'                      => 'Gear\Event\LogListener',
            'Gear\Creator\Template'            => 'Gear\Creator\TemplateService',
            'consoleService'                   => 'Gear\Service\ConsoleService',
        ),
        'aliases' => array(
        	'Gear\Service\Mvc\ConfigService'   => 'configService',
            'dirService'                       => 'GearBase\Util\Dir',
            'fileService'                      => 'GearBase\Util\File',
            'stringService'                    => 'GearBase\Util\String',
            'fileCreator'                      => 'fileCreatorFactory'
        ),
        'shared' => array(
    	    'fileCreatorFactory'               => false,
            'Gear\Autoload\Namespaces'         => false,
        ),
    ),
    require __DIR__.'/servicemanager/mvc.php',
    require __DIR__.'/servicemanager/constructor.php',
    require __DIR__.'/servicemanager/module.php',
    require __DIR__.'/servicemanager/database.php',
    require __DIR__.'/servicemanager/project.php',
    require __DIR__.'/servicemanager.config.php'
);
