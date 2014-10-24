<?php
namespace Gear;

use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Gear\Common\ConfigAwareInterface;
use Gear\Common\ClassServiceAwareInterface;
use Gear\Common\ModuleAwareInterface;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\Console\ColorInterface;

class Module implements ConsoleUsageProviderInterface
{

    public function init(ModuleManager $moduleManager)
    {
        $eventManager = $moduleManager->getEventManager();
        $shareManager = $eventManager->getSharedManager();
        $shareManager->attach('Gear\Controller\IndexController', 'dependsSecurity', function($event) use($moduleManager) {
            $loadedModules = $moduleManager->getLoadedModules();
            $loadedModules      = array_keys($loadedModules);
            if (!in_array('Security', $loadedModules)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Security need to be loaded to run'
                    )
                );
            }
        });




        $shareManager->attach('Gear\Service\AclService', 'loadModules', function($event) use ($moduleManager) {
            $loadedModules = $moduleManager->getLoadedModules();
            $merge = [***REMOVED***;

            foreach ($loadedModules as $moduleName => $module) {
                if (method_exists($module, 'getConfig')) {
                    $config = $module->getConfig();
                    if (isset($config['acl'***REMOVED***[$moduleName***REMOVED***) && $config['acl'***REMOVED***[$moduleName***REMOVED*** === true) {
                        $merge[$moduleName***REMOVED*** = $module;
                    }
                }
            }

            $service = $event->getTarget();
            $service->setLoadedModules($merge);
        });
    }

    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $application = $event->getApplication();

        $serviceManager = $event->getApplication()->getServiceManager();
        // get the shared events manager
        $sharedManager = $application->getEventManager()->getSharedManager();

        //$shareManager->attach('')

        // listen to 'MyEvent' when triggered by the IndexController



        $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController',  'dispatch', function($event)
            use ($serviceManager) {
            $controller = $event->getTarget();
            $controller->getEventManager()->attachAggregate($serviceManager->get('SchemaListener'));
            $controller->getEventManager()->attachAggregate($serviceManager->get('LogListener'));
        }, 2);

        $sharedManager->attach('Gear\Controller\IndexController', 'module.pre', function($event) {
            // do something...

            $module = $event->getTarget()->getRequest()->getParam('module');

            if (empty($module)) {
                throw new \InvalidArgumentException('Module need to be set to run this action');
            }
        });

        $sharedManager->attach('Gear\Controller\IndexController', 'console.pre', function($event) {
            // do something...

            if (!$event->getTarget()->getRequest() instanceof  \Zend\Console\Request) {
                throw new \RuntimeException('You can only use this action from a console!');
            }
        });

    }


    public function getConsoleUsage(Console $console)
    {
        return array(
            'gear -v'                                                                       => 'Shows the gear version',
            'gear src <action> <srcType> [<options>***REMOVED***'                                       => 'Execute actions for src files',
            'gear migrate'                                                                  => 'Migrate project',
            'gear dump <module> <type>'                                                     => 'Dump a schema from a module in Json and Array',
            'gear module create <module>'                                                   => 'Create a new basic module with IndexAction',
            'gear module remove <module>'                                                   => 'Removes full module',
            'gear module add-config <module>'                                               => 'Add a module to the application.config.php',
            'gear module del-config <module>'                                               => 'Delete a module from the application.config.php',
            'gear create crud <project> <path> <module> [<table_prefix>***REMOVED***'                   => 'Create full suite for all tables',
            'gear create entities <project> <path> <module> [<table_prefix>***REMOVED***'               => 'Create by doctrine all entities for project',
            'gear create project <project> <path>'                                          => 'Create a new skeleton app',
            'gear create file <project> <path> <module> <file> [<table>***REMOVED*** [<table_prefix>***REMOVED***'  => 'Create a new file from a specified format',
            'gear create lego <project> <path> <module> <piece> [<table>***REMOVED*** [<table_prefix>***REMOVED***' => 'Create a single piece of software',
            'gear create crud-unique <project> <path> <module> <table> [<table_prefix>***REMOVED*** [<exclude>***REMOVED***' => 'Create a full suite for a single table with exclude options'
        );
    }

    public function getServiceConfig()
    {
        return array(
            'initializers' => array(
                'Gear\Initializer\DirInitializer',
                'Gear\Initializer\ClassInitializer',
                'Gear\Initializer\ConfigInitializer',
                'Gear\Initializer\ModuleInitializer',
            ),
            'factories' => array(
                'moduleService'   => 'Gear\Factory\ModuleServiceFactory',
            ),
            'invokables' => array(
                'ConstructorController'    => 'Gear\Constructor\ControllerMaker',
                'doctrineService'           => 'Gear\Service\DoctrineService',
                'versionService'            => 'Gear\Service\VersionService',
                'moduleStructure'           => 'Gear\ValueObject\BasicModuleStructure',
                'aclService'                => 'Gear\Service\AclService',
                'scriptService'             => 'Gear\Service\Module\ScriptService',
                'migrateService'            => 'Gear\Service\MigrateService',
                'gearingService'            => 'Gear\Service\GearingService',
                'projectService'            => 'Gear\Service\ProjectService',
                'buildService'              => 'Gear\Service\Module\BuildService',
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
    }


    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'arrayToYml' => function () {
                    $arrayToYml = new \Gear\View\Helper\ArrayToYml();

                    return $arrayToYml;
                },
                'str' => function($serviceLocator) {
                    $str = new \Gear\View\Helper\Str();
                    $str->setServiceLocator($serviceLocator->getServiceLocator());
                    return $str;
                },
                'dependencyInjection' => function($serviceLocator) {
                    $dependencyInjection = new \Gear\View\Helper\DependencyInjection();
                    $dependencyInjection->setServiceLocator($serviceLocator->getServiceLocator());
                    return $dependencyInjection;
                },
                'use' => function($serviceLocator) {
                    $useNaming = new \Gear\View\Helper\UseNaming();
                    $useNaming->setServiceLocator($serviceLocator->getServiceLocator());
                    return $useNaming;
                },
                'attribute' => function($serviceLocator) {
                    $attribute = new \Gear\View\Helper\Attribute();
                    $attribute->setServiceLocator($serviceLocator->getServiceLocator());
                    return $attribute;
                }
            )
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

    public function getLocation()
    {
        return __DIR__;
    }
}
