<?php
return array(
    'initializers' => array(
        'Gear\Initializer\DirInitializer',
        'Gear\Initializer\ClassInitializer',
        'Gear\Initializer\ConfigInitializer',
        'Gear\Initializer\ModuleInitializer',
        'Gear\Initializer\TemplateInitializer'
    ),
    'factories' => array(
        'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        'moduleService'   => 'Gear\Factory\ModuleServiceFactory',
        'moduleConfig'    => 'Gear\Factory\ConfigFactory',
        'Gear\Schema'         => 'Gear\Factory\SchemaFactory',
        'Gear\Factory\Metadata' => 'Gear\Factory\MetadataFactory',
        'fileCreatorFactory' => 'Gear\Factory\FileCreatorFactory'
    ),
    'invokables' => array(
        'backupService'      => 'Gear\Service\Db\BackupService',
        'Gear\Service\Db\SchemaTool' => 'Gear\Service\Db\SchemaToolService',
        'RepositoryService\MappingService' => 'Gear\Service\Mvc\RepositoryService\MappingService',
        'Gear\Speciality\SimpleCheckbox' => 'Gear\Service\Speciality\SimpleCheckbox',
        'Gear\Speciality\MetaTags' => 'Gear\Service\Speciality\MetaTags',
        'Gear\Speciality\MetaImagem' => 'Gear\Service\Speciality\MetaImagem',
        'Gear\Service\Db\Table' => 'Gear\Service\Db\TableService',
        'Gear\Service\Deploy' => 'Gear\Service\DeployService',
        'Gear\Service\Config' => 'Gear\Service\ConfigService',
        'Gear\Service\Mvc\SearchService' => 'Gear\Service\Mvc\SearchService',
        'SchemaListener' => 'Gear\Event\SchemaListener',
        'LogListener' => 'Gear\Event\LogListener',
        'templateService'       => 'Gear\Service\TemplateService',
        'controllerConstructor' => 'Gear\Service\Constructor\ControllerService',
        'actionConstructor'     => 'Gear\Service\Constructor\ActionService',
        'pageConstructor'       => 'Gear\Service\Constructor\PageService',
        'viewConstructor'       => 'Gear\Service\Constructor\ViewService',
        'testConstructor'       => 'Gear\Service\Constructor\TestService',
        'Gear\Service\Mvc\FixtureService'        => 'Gear\Service\Mvc\FixtureService',
        'srcConstructor'        => 'Gear\Service\Constructor\SrcService',
        'dbConstructor'         => 'Gear\Service\Constructor\DbService',
        'doctrineService'           => 'Gear\Service\DoctrineService',
        'versionService'            => 'Gear\Service\VersionService',
        'moduleStructure'           => 'Gear\ValueObject\BasicModuleStructure',
        'aclService'                => 'Gear\Service\AclService',
        'scriptService'             => 'Gear\Service\Module\ScriptService',
        'migrateService'            => 'Gear\Service\MigrateService',
        'gearingService'            => 'Gear\Service\GearingService',
        'projectService'            => 'Gear\Service\ProjectService',
        'buildService'              => 'Gear\Service\BuildService',
        'srcFactory'                => 'Gear\Factory\SrcFactory',
        'danceRepository'           => 'Gear\Repository\DanceRepository',
        'jsonService'               => 'Gear\Service\Constructor\JsonService',
        'srcService'                => 'Gear\Service\Constructor\SrcService',
        'pageService'               => 'Gear\Service\Constructor\PageService',
        'dbService'                 => 'Gear\Service\Constructor\DbService',
        'creatorService'            => 'Gear\Service\CreatorService',
        'serviceService'            => 'Gear\Service\Mvc\ServiceService',
        'viewService'               => 'Gear\Service\Mvc\ViewService',
        'ViewService\TableService'  => 'Gear\Service\Mvc\ViewService\TableService',
        'ViewService\FormService'  => 'Gear\Service\Mvc\ViewService\FormService',
        'ViewService\SearchService'  => 'Gear\Service\Mvc\ViewService\SearchService',
        'codeceptionService'        => 'Gear\Service\Test\CodeceptionService',
        'zendServiceLocatorService' => 'Gear\Service\Test\ZendServiceLocatorService',
        'controllerTestService'     => 'Gear\Service\Test\ControllerTestService',
        'functionalTestService'     => 'Gear\Service\Test\FunctionalTestService',
        'repositoryTestService'         => 'Gear\Service\Test\RepositoryTestService',
        'serviceTestService'         => 'Gear\Service\Test\ServiceTestService',
        'acceptanceTestService'     => 'Gear\Service\Test\AcceptanceTestService',
        'pageTestService'           => 'Gear\Service\Test\PageTestService',
        'configService'             => 'Gear\Service\Mvc\ConfigService',
        'controllerService'         => 'Gear\Service\Mvc\ControllerService',
        'layoutService'             => 'Gear\Service\Mvc\LayoutService',
        'testService'               => 'Gear\Service\Module\TestService',
        'composerService'           => 'Gear\Service\Module\ComposerService',
        'classService'              => 'Gear\Service\Type\ClassService',
        'dirService'                => 'Gear\Service\Filesystem\DirService',
        'fileService'               => 'Gear\Service\Filesystem\FileService',
        'stringService'             => 'Gear\Service\Type\StringService',
        'moduleFileService'         => 'Gear\Service\Module\ModuleFileService',
        'filesystemService'         => 'Gear\Service\FilesystemService',
        'tableService'              => 'Gear\Service\TableService',
        'specialityService'         => 'Gear\Service\SpecialityService',
        'module_gear'               => 'Gear\Model\ModuleGear',
        'database_gear'             => 'Gear\Model\DatabaseGear',
        'sql_gear'                  => 'Gear\Model\SqlGear',
        'consoleService'            => 'Gear\Service\ConsoleService',
        'integrationService'        => 'Gear\Service\IntegrationService',
        'power_gear'                => 'Gear\Model\PowerGear',
        'languageService'           => 'Gear\Service\LanguageService',
        'entityService'             => 'Gear\Service\Mvc\EntityService',
        'entityTestService'         => 'Gear\Service\Test\EntityTestService',
        'repositoryService'         => 'Gear\Service\Mvc\RepositoryService',
        'repositoryTestService'     => 'Gear\Service\Test\RepositoryTestService',
        'formService'               => 'Gear\Service\Mvc\FormService',
        'formTestService'           => 'Gear\Service\Test\FormTestService',
        'filterService'             => 'Gear\Service\Mvc\FilterService',
        'filterTestService'         => 'Gear\Service\Test\FilterTestService',
        'factoryService'            => 'Gear\Service\Mvc\FactoryService',
        'factoryTestService'        => 'Gear\Service\Test\FactoryTestService',
        'valueObjectService'        => 'Gear\Service\Mvc\ValueObjectService',
        'valueObjectTestService'    => 'Gear\Service\Test\ValueObjectTestService',
        'controllerPluginService'      => 'Gear\Service\Mvc\ControllerPluginService',
        'controllerPluginTestService'  => 'Gear\Service\Test\ControllerPluginTestService',
    ),
    'aliases' => array(
    	'Gear\Service\Mvc\ConfigService' => 'configService',
        'Gear\Service\Type\String' => 'stringService',
        'Gear\Service\Filesystem\Dir' => 'dirService',
        'Gear\Service\Filesystem\File' => 'fileService',
        'Gear\Service\Template'    => 'templateService',
        'Gear\Service\Constructor\Json'    => 'jsonService'
    ),
    'shared' => array(
	    'fileCreatorFactory' => false
),
);
