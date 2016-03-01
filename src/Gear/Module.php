<?php
namespace Gear;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use ZendDiagnostics\Check\DirWritable;
use ZendDiagnostics\Check\ExtensionLoaded;
use ZendDiagnostics\Check\ProcessRunning;
use ZendDiagnostics\Check\PhpVersion;
use ZendDiagnostics\Check\CpuPerformance;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Module implements
    ConsoleUsageProviderInterface,
    ConsoleBannerProviderInterface,
    ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $moduleManager;

    public function getConsoleBanner(Console $console)
    {
        $version = '2';
        $version = require __DIR__.'/../../config/module.config.php';

        $banner = sprintf(
            'Gear - v%s - Poderoso Gear.',
            $version['gear'***REMOVED***['version'***REMOVED***
        );

        return $banner;
    }

    public function setModuleManager($moduleManager)
    {
        $this->moduleManager = $moduleManager;
        return $this;
    }

    public function getModuleManager()
    {
        return $this->moduleManager;
    }

    public function loadFixtures($event)
    {
        $loadedModules = $this->getModuleManager()->getLoadedModules();
        $merge = [***REMOVED***;

        foreach ($loadedModules as $moduleName => $module) {
            if (method_exists($module, 'getConfig')) {
                $config = $module->getConfig();
                if (isset($config['data-fixture'***REMOVED***)) {
                    foreach ($config['data-fixture'***REMOVED*** as $name => $location) {
                        $merge[$moduleName***REMOVED*** = $location;
                    }
                }
            }
        }
        $service = $event->getTarget();
        $service->setLoadedFixtures($merge);
    }

    public function setUpAcl($event)
    {
        $loadedModules = $this->getModuleManager()->getLoadedModules();
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
    }

    public function setUpGearAdmin($event)
    {
        $loadedModules = $this->getModuleManager()->getLoadedModules();
        $loadedModules      = array_keys($loadedModules);
        if (!in_array('GearAdmin', $loadedModules)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'GearAdmin need to be loaded to run'
                )
            );
        }
    }


    public function setUpModule($event)
    {
        $module = $event->getTarget()->getRequest()->getParam('module');

        if (empty($module)) {
            throw new \InvalidArgumentException('Module need to be set to run this action');
        }
    }

    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $application = $event->getApplication();

        $serviceManager = $event->getApplication()->getServiceManager();
        $this->setServiceLocator($serviceManager);
        // get the shared events manager
        $sharedManager = $application->getEventManager()->getSharedManager();

        $sharedManager->attach(
            'Zend\Mvc\Controller\AbstractActionController',
            'dispatch',
            function ($event) use ($serviceManager) {
                $controller = $event->getTarget();
                $controller->getEventManager()->attachAggregate($serviceManager->get('SchemaListener'));
            },
            2
        );

        $sharedManager->attach(
            '*',
            'init',
            function ($event) use ($serviceManager) {

                $controller = $event->getTarget();
                $controller->getEventManager()->attachAggregate($serviceManager->get('SchemaListener'));
            },
            2
        );


        $sharedManager->attach('Gear\Controller\IndexController', 'module.pre', [$this, 'setUpModule'***REMOVED***);
    }

    public function init(ModuleManager $moduleManager)
    {
        $this->setModuleManager($moduleManager);
        $eventManager = $moduleManager->getEventManager();
        $shareManager = $eventManager->getSharedManager();
        $shareManager->attach('Gear\Service\AclService', 'loadModules', [$this, 'setUpAcl'***REMOVED***);
        $shareManager->attach('Gear\Mvc\Fixture\FixtureService', 'loadFixtures', [$this, 'loadFixtures'***REMOVED***);
    }

    public function getConsoleUsage(Console $console)
    {
        return [
            'Projects',
            'gear project create' => 'Criar um novo projeto',

            [ 'project', 'Required', 'Project Name'***REMOVED***,
            [ '--database=', 'Required', 'A database to use'***REMOVED***,
            [ '--username=', 'Required', 'Username of database'***REMOVED***,
            [ '--password=', 'Required', 'Password of username'***REMOVED***,
            [ '--host=', 'Optional', 'Host to create a Virtual Host'***REMOVED***,
            [ '--git=', 'Optional', 'Git to use as remote repository'***REMOVED***,
            [ '--nfs', 'Optional', 'Nfs to share and work on files'***REMOVED***,

            'gear project dump-autoload' => 'Adiciona os módulos ao arquivo autoloader_namespace.php',
            'gear project helper' => '',
            'gear project diagnostics' => '',
            'gear project fixture [--append***REMOVED*** [--reset-autoincrement***REMOVED***' => '',
            'gear project setUpGlobal --host= --dbname=  --dbms= --environment= ' => '',
            'gear project setUpLocal --username= --password= ' => '',
            'gear project setUpEnvironment --environment=' => '',
            'gear project setUpConfig --host= --dbname=  --username= --password= --environment= --dbms=' => '',
            'gear project deploy <environment>' => '',
            'gear project nfs' => '',
            'gear project virtual-host' => '',
            'gear project git' => '',

            'Config',

            'gear config add <path> <key> <value>' => 'Adiciona um valor em um array de configuração',
            ['path', 'Required', 'Local onde será adicionado'***REMOVED***,
            ['key', 'Required', 'Chave que será adicionada'***REMOVED***,
            ['value', 'Required', 'Valor que será associado'***REMOVED***,

            'gear config update <key> <value>' => 'Editar um valor em um array',
            ['path', 'Required', 'Local onde será adicionado'***REMOVED***,
            ['key', 'Required', 'Chave que será adicionada'***REMOVED***,
            ['value', 'Required', 'Chave que será adicionada'***REMOVED***,

            'gear config show <key>' => 'Exibir o valor de um array',
            ['path', 'Required', 'Local onde será adicionado'***REMOVED***,
            ['key', 'Required', 'Chave que será adicionada',***REMOVED***,

            'gear config delete <key>' => 'Deletar um elemento de um array',
            ['path', 'Required', 'Local onde será adicionado'***REMOVED***,
            ['key', 'Required', 'Chave que será adicionada',***REMOVED***,

            //Module
            'Module',
            'gear module fixture  <module> [--append***REMOVED*** [--reset-increment***REMOVED***' => '',
            'gear module create   <module> [--build=***REMOVED*** [--layout=***REMOVED*** [--no-layout***REMOVED***' => '',
            'gear module create   <module> --light [--ci***REMOVED*** [--build=***REMOVED*** [--doctrine***REMOVED*** '
            .'[--doctrine-fixture***REMOVED*** [--unit***REMOVED*** [--codeception***REMOVED*** [--gear***REMOVED***' => '',
            'gear module delete   <module>' => '',
            'gear module load     <module> [--before=***REMOVED*** [--after=***REMOVED***' => '',
            'gear module unload   <module>' => '',
            'gear module build    <module> [--trigger=***REMOVED*** [--domain=***REMOVED***' => '',
            'gear module push     <module> --description=' => '',
            'gear module dump     <module> [--json***REMOVED*** [--array***REMOVED***' => '',
            'gear module entities <module>' => '',
            'gear module entity   <module> --entity=' => '',

            'Module/Constructor',
            'gear module controller create' => 'Criar Controller',

            ['<module>', 'Required', 'Módulo'***REMOVED***,
            ['<basepath>', 'Optional', 'Localização do Módulo'***REMOVED***,
            ['--name=', 'Required', 'Nome do Controller'***REMOVED***,
            ['--service=', 'Required', 'Tipo do Servico, invokables ou factory.'***REMOVED***,
            ['--extends=', 'Optional', ''***REMOVED***,
            ['--type=', 'Optional', ''***REMOVED***,
            ['--namespace=', 'Optional', ''***REMOVED***,
            ['--db=', 'Optional', ''***REMOVED***,
            ['--columns', 'Optional', ''***REMOVED***,

            'gear module activity create' => 'Criar Action',

            ['<module>', 'Required', ''***REMOVED***,
            ['<basepath>', 'Optional', ''***REMOVED***,
            ['<parent>', 'Required', ''***REMOVED***,
            ['--name=', 'Required', ''***REMOVED***,
            ['--template=', 'Optional', ''***REMOVED***,
            ['--route=***REMOVED***', 'Optional', ''***REMOVED***,
            ['--role=***REMOVED***', 'Optional', ''***REMOVED***,
            ['--dependency=***REMOVED***', 'Optional', ''***REMOVED***,


            'gear module app create|delete' => 'Criar App',
            ['<module>', 'Required', ''***REMOVED***,
            ['<basepath>', 'Optional', ''***REMOVED***,
            ['--type=', 'Required', ''***REMOVED***,
            ['--name=', 'Required', ''***REMOVED***,
            ['--namespace=', 'Optional', ''***REMOVED***,
            ['--db=', 'Optional', ''***REMOVED***,

            'gear module src create|delete' => 'Criar Src',
            ['<module>', 'Required', ''***REMOVED***,
            ['<basepath>', 'Optional', ''***REMOVED***,
            ['--type=', 'Required', ''***REMOVED***,
            ['--name=', 'Required', ''***REMOVED***,
            ['--namespace=', 'Optional', ''***REMOVED***,
            ['--service=', 'Optional', ''***REMOVED***,
            ['--template=', 'Optional', ''***REMOVED***,
            ['--abstract', 'Optional', ''***REMOVED***,
            ['--dependency=', 'Optional', ''***REMOVED***,
            ['--extends=', 'Optional', ''***REMOVED***,
            ['--db=', 'Optional', ''***REMOVED***,
            ['--columns=', 'Optional', ''***REMOVED***,


            'gear module db create|delete' => 'Criar Mvc',
            ['<module>', 'Required', ''***REMOVED***,
            ['[<basepath>***REMOVED***', 'Optional', ''***REMOVED***,
            ['--table=', 'Required', ''***REMOVED***,
            ['[--user=***REMOVED***', 'Optional', ''***REMOVED***,
            ['[--default-role=***REMOVED***', 'Optional', ''***REMOVED***,
            ['[--columns=***REMOVED***', 'Optional', ''***REMOVED***,


            'gear module test create|delete' => 'Criar um Test/Spec',
            ['<module>', 'Required', 'Módulo'***REMOVED***,
            ['--suite=', 'Required', 'Tipo, pode ser unit, karma ou protractor.'***REMOVED***,
            ['--target=', 'Required', 'Local onde arquivo será salvo'***REMOVED***,

            'gear module view create|delete ' => 'Criar uma View.',
            ['<module>', 'Required', 'Módulo'***REMOVED***,
            ['--target=', 'Required', 'View que será criada'***REMOVED***,



            'gear module dump-autoload <module>' => '',


            //database
            'Database',
            'gear database mysql2sqlite --from= --target=' => '',
            'gear database analyse' => '',
            'gear database analyse table <table>' => '',
            'gear database fix' => '',
            'gear database fix table <table>' => '',
            'gear database autoincrement' => '',
            'gear database autoincrement table <table>' => '',
            'gear database order' => '',
            'gear database create table <name>' => '',
            'gear database create column  <table> <name> <type> [--limit=***REMOVED*** [--null=***REMOVED***' => '',
            'gear database create constraint <table> <column> <constraintType> '
            . '<refTable> <refColumn> <updateRule> <deleteRule>' => '',
            'gear database drop table <table>' => '',
            'gear database drop column <table> <name>' => '',
            'gear database drop constraint <table> <column>' => '',
            'gear database mysql load <location>' => '',
            'gear database mysql dump <location> [<name>***REMOVED***' => '',

            'Cache',
            'gear cache renew --data' => '',
            'gear cache renew --memcached' => ''

        ***REMOVED***;
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/../../autoload_classmap.php',
            ***REMOVED***,
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ***REMOVED***,
            ***REMOVED***,
        ***REMOVED***;
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getLocation()
    {
        return __DIR__;
    }

    public function getDiagnostics()
    {
        return [
            'Cache & Log Directories Available' => function () {
                $folder = \Gear\ValueObject\Project::getStaticFolder();
                $diagnostic = new DirWritable([
                    $folder . '/data/cache',
                    $folder . '/data/logs',
                    __DIR__ . '/Entity',
                ***REMOVED***);
                return $diagnostic->check();
            },
            'Check PHP extensions' => function () {
                $diagnostic = new ExtensionLoaded([
                    'json',
                    'pdo',
                    'pdo_mysql',
                    'intl',
                ***REMOVED***);
                return $diagnostic->check();
            },
            'Check Apache is running' => function () {
                $diagnostic = new ProcessRunning('apache2');
                return $diagnostic->check();
            },
            'CPU Performance' => function () {
                $diagnostic = new CpuPerformance(0.5);
                return $diagnostic->check();
            },
            'Check Mysql is running' => function () {
                $diagnostic = new ProcessRunning('mysql');
                return $diagnostic->check();
            },
            'Check PHP Version' => function () {
                $diagnostic = new PhpVersion('5.5.0', '>=');
                return $diagnostic->check();
            }
        ***REMOVED***;
    }
}
