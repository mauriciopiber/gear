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
        'Gear\Module\GitIgnore' => 'Gear\Module\GitIgnore',
        'Gear\Javascript\Module\Package' => 'Gear\Javascript\Module\Package',
        'Gear\Javascript\Module\Gulpfile' => 'Gear\Javascript\Module\Gulpfile',
        'Gear\Javascript\Module\Protractor' => 'Gear\Javascript\Module\Protractor',
        'Gear\Javascript\Module\Karma' => 'Gear\Javascript\Module\Karma',
        'Gear\Autoload\Namespaces'    => 'Gear\Autoload\Namespaces',
        'Gear\ContinuousIntegration\Jenkins' => 'Gear\ContinuousIntegration\Jenkins',




        'Gear\Service\Deploy' => 'Gear\Service\DeployService',
        'Gear\Service\Version' => 'Gear\Service\VersionService',
        'Gear\Config\AssetManager' => 'Gear\Config\AssetManager',

        'Gear\Service\Config' => 'Gear\Service\ConfigService',

        'SchemaListener' => 'Gear\Event\SchemaListener',
        'LogListener' => 'Gear\Event\LogListener',
        'templateService'       => 'Gear\Service\TemplateService',



        'versionService'            => 'Gear\Service\VersionService',
        'moduleStructure'           => 'Gear\ValueObject\BasicModuleStructure',
        'aclService'                => 'Gear\Service\AclService',

        'migrateService'            => 'Gear\Service\MigrateService',
        'gearingService'            => 'Gear\Service\GearingService',
        'projectService'            => 'Gear\Service\ProjectService',
        'Gear\Project\Upgrade'      => 'Gear\Project\Upgrade',
        'buildService'              => 'Gear\Service\BuildService',
        'cacheService'              => 'Gear\Cache\CacheService',
        'srcFactory'                => 'Gear\Factory\SrcFactory',
        'creatorService'            => 'Gear\Service\CreatorService',
        'layoutService'             => 'Gear\Service\Mvc\LayoutService',

        'classService'              => 'Gear\Service\Type\ClassService',
        'dirService'                => 'Gear\Service\Filesystem\DirService',
        'fileService'               => 'Gear\Service\Filesystem\FileService',
        'stringService'             => 'Gear\Service\Type\StringService',
        'moduleFileService'         => 'Gear\Service\Module\ModuleFileService',
        'filesystemService'         => 'Gear\Service\FilesystemService',
        'tableService'              => 'Gear\Service\TableService',
        'specialityService'         => 'Gear\Service\SpecialityService',
        'consoleService'            => 'Gear\Service\ConsoleService',
        'integrationService'        => 'Gear\Service\IntegrationService',
    ),
    'aliases' => array(
    	'Gear\Service\Mvc\ConfigService' => 'configService',
        'Gear\Service\Type\String' => 'stringService',
        'Gear\Service\Filesystem\Dir' => 'dirService',
        'Gear\Service\Filesystem\File' => 'fileService',
        'Gear\Service\Template'    => 'templateService',
        'Gear\Service\Constructor\Json'    => 'jsonService',
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
    require __DIR__.'/servicemanager.config.php'
);
