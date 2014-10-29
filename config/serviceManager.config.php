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
        'moduleService'   => 'Gear\Factory\ModuleServiceFactory',
    ),
    'invokables' => array(
        'SchemaListener' => 'Gear\Event\SchemaListener',
        'LogListener' => 'Gear\Event\LogListener',
        'templateService'       => 'Gear\Service\TemplateService',
        'controllerConstructor' => 'Gear\Service\Constructor\ControllerService',
        'actionConstructor'     => 'Gear\Service\Constructor\ActionService',
        'pageConstructor'       => 'Gear\Service\Constructor\PageService',
        'viewConstructor'       => 'Gear\Service\Constructor\ViewService',
        'testConstructor'       => 'Gear\Service\Constructor\TestService',
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
        'codeceptionService'           => 'Gear\Service\Test\CodeceptionService',
        'zendServiceLocatorService' => 'Gear\Service\Test\ZendServiceLocatorService',
        'controllerTestService'     => 'Gear\Service\Test\ControllerTestService',
        'functionalTestService'     => 'Gear\Service\Test\FunctionalTestService',
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
    )
);