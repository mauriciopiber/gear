<?php
namespace Gear;

use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Gear\Common\ConfigAwareInterface;
use Gear\Common\ClassServiceAwareInterface;
use Gear\Common\ModuleAwareInterface;

class Module implements ConsoleUsageProviderInterface
{

    public function getConsoleUsage(Console $console)
    {
        return array(
            'gear -v'                                                                       => 'Shows the gear version',
            'gear src <action> <srcType> [<options>***REMOVED***'                                       => 'Execute actions for src files',
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

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'arrayToYml' => function () {
                    $arrayToYml = new \Gear\View\Helper\ArrayToYml();

                    return $arrayToYml;
                }
             )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'initializers' => array(
                'dirServiceAwareInterface' => function ($model, $serviceLocator) {
                    if ($model instanceof DirServiceAwareInterface) {
                        $dirWriter = $serviceLocator->get('dirService');
                        $model->setDirService($dirWriter);
                    }
                },
                'classServiceAwareInterface' => function ($model, $serviceLocator) {
                    if ($model instanceof ClassServiceAwareInterface) {
                        $classService = $serviceLocator->get('classService');
                        $model->setClassService($classService);
                    }
                },
                'configAwareInterface' => function ($model, $serviceLocator) {
                    if ($model instanceof ConfigAwareInterface) {
                        $request = $serviceLocator->get('request');
                        $module = $request->getParam('module');

                        if (empty($module)) {
                            throw new \Exception(sprintf('Module was not set on %s', get_class($model)));
                        }

                        $config = new \Gear\ValueObject\Config\Config($module,'entity',null);
                        $model->setConfig($config);
                    }
                },
                'moduleAwareInterface' => function ($model, $serviceLocator) {
                    if ($model instanceof ModuleAwareInterface) {
                        $request = $serviceLocator->get('request');
                        $module = $request->getParam('module');
                        $structure = new \Gear\ValueObject\BasicModuleStructure();
                        $request = $serviceLocator->get('request');
                        $module = $request->getParam('module');
                        $config = new \Gear\ValueObject\Config\Config($module,'entity',null);
                        $structure->setConfig($config);
                        $struc = $structure->prepare();
                        $model->setModule($struc);

                    }
                }
            ),
            'factories' => array(
                'tableRepository' => function ($serviceLocator) {
                    $tableRepository = new \Gear\Repository\TableRepository($serviceLocator->get('Zend\Db\Adapter\Adapter'));

                    return $tableRepository;
                },
                'moduleService'   => 'Gear\Factory\ModuleServiceFactory',
            ),
            'invokables' => array(
                'moduleStructure'           => 'Gear\ValueObject\BasicModuleStructure',
                'scriptService'             => 'Gear\Service\Module\ScriptService',
                'gearingService'            => 'Gear\Service\GearingService',
                'projectService'            => 'Gear\Service\ProjectService',
                'buildService'              => 'Gear\Service\Module\BuildService',
                'srcFactory'                => 'Gear\Factory\SrcFactory',
                'danceRepository'           => 'Gear\Repository\DanceRepository',
                'jsonService'               => 'Gear\Service\Constructor\JsonService',
                'srcService'                => 'Gear\Service\Constructor\SrcService',
                'pageService'               => 'Gear\Service\PageService',
                'dbService'                 => 'Gear\Service\Constructor\DbService',
                'creatorService'            => 'Gear\Service\CreatorService',
                'serviceService'            => 'Gear\Service\Mvc\ServiceService',
                'viewService'               => 'Gear\Service\Mvc\ViewService',
                'codeceptionService'           => 'Gear\Service\Test\CodeceptionService',
                'zendServiceLocatorService' => 'Gear\Service\Test\ZendServiceLocatorService',
                'controllerTestService'     => 'Gear\Service\Mvc\ControllerTestService',
                'functionalTestService'     => 'Gear\Service\Mvc\FunctionalTestService',
                'acceptanceTestService'     => 'Gear\Service\Mvc\AcceptanceTestService',
                'pageTestService'           => 'Gear\Service\Mvc\PageTestService',
                'configService'             => 'Gear\Service\Mvc\ConfigService',
                'controllerService'         => 'Gear\Service\Mvc\ControllerService',
                'layoutService'             => 'Gear\Service\Mvc\LayoutService',
                'testService'               => 'Gear\Service\Module\TestService',
                'composerService'           => 'Gear\Service\Module\ComposerService',
                'classService'              => 'Gear\Service\Filesystem\ClassService',
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
                'power_gear'                => 'Gear\Model\PowerGear',
            )
        );
    }
    /*
    public function getControllerConfig()
    {

        return array(
            'factories' => array(
                'Gear\Controller\Index' => function($controllers) {
                    $serviceLocator  = $controllers->getServiceLocator();
                    $events          = $serviceLocator->get('eventmanager');
                    $pageService     = $serviceLocator->get('pageService');
                    $moduleService   = $serviceLocator->get('moduleService');
                    $projectService  = $serviceLocator->get('projectService');
                    $indexController = new \Gear\Controller\IndexController($projectService, $moduleService, $pageService);

                    $events->attach('dispatch', function ($e) use ($indexController) {
                        //var_dump(get_class($e));die();
                        $request = $e->getRequest();
                        // your own initialization logic here

                    }, 500); // run before controller action logic

                    $indexController->setEventManager($events);
                    $indexController->setServiceLocator($controllers);
                    //$indexController->set
                    return $indexController;

                }
            )
        );

    }
*/
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
}
