<?php
namespace Gear\Controller;

use Zend\Console\ColorInterface;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractConsoleController;
use Gear\Model\ModuleGear;
use Gear\Model\EntityGear;
use Zend\Console\Console;
use Zend\View\Model\ConsoleModel;

class IndexController extends AbstractConsoleController
{
    protected $moduleService;

    protected $projectService;

    protected $pageService;

    protected $dbService;

    protected $srcService;

    protected $aclService;

    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function moduleAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $request    = $this->getRequest();


        $verbose    = $request->getParam('verbose') || $request->getParam('v');
        $color      = $request->getParam('color') || $request->getParam('c');
        $create     = $request->getParam('create', null);
        $delete     = $request->getParam('delete', null);

        $module     = $this->getModuleService();

        $moduleName = $module->getConfig()->getModule();

        if ($create) {

            $welcome = sprintf('Criar módulo %s no projeto localizado na pasta %s/%s', $moduleName, \Gear\ValueObject\Project::getStaticFolder(), $moduleName);
            $module->outputBlue($welcome);

            $success = $module->createEmptyModule($request->getParam('build', null));
            if ($success) {
                $module->outputBlue($success);
            } else {

            }
        } elseif ($delete) {

            $welcome = sprintf('Deletar módulo %s no projeto localizado na pasta %s/%s', $moduleName, \Gear\ValueObject\Project::getStaticFolder(), $moduleName);
            $module->outputRed($welcome);

            $success = $module->delete();
            if ($success) {
                $module->outputRed($success);
            }
        } else {
            $module->outputRed("No action executed");
        }
    }

    public function projectAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $request = $this->getRequest();

        $projectFilter = new \Gear\Filter\Project();

        if ($projectFilter->valid($request->getParams())) {

            $project = $request->getParam('project', null);
            $host    = $request->getParam('host', null);
            $git     = $request->getParam('git', null);

            $projectService = $this->getProjectService();

            $create     = $request->getParam('create', null);
            $delete     = $request->getParam('delete', null);

            if ($create) {
                return $projectService->create($project, $host, $git);
            } elseif ($delete) {
                return $projectService->delete($project);
            }

        } else {
            return 'No action provided to \Gear\Service\ProjectService';
        }

    }

    public function srcAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $console = $this->getServiceLocator()->get('Console');

        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $type = $request->getParam('type');

        if (empty($type)) {
            return 'Type not specified';
        }

        $name = $request->getParam('name');

        if (empty($name)) {
            return 'Name not specified';
        }

        $srcService = $this->getSrcService();


        $srcValueObject = new \Gear\ValueObject\Src();
        $srcValueObject->setType($type);
        $srcValueObject->setName($name);

        $welcome = sprintf(
            'Criar Source %s do tipo %s para o módulo %s do projeto localizado na pasta %s/%s',
            $srcValueObject->getName(),
            $srcValueObject->getType(),
            $srcService->getConfig()->getModule(),
            \Gear\ValueObject\Project::getStaticFolder(),
            $srcService->getConfig()->getModule()
        );
        $srcService->outputBlue($welcome);



        $srcService->setSrcValueObject($srcValueObject);

        $status = $srcService->factory();

        if ($status) {
            $welcome = sprintf(
                'Source %s criado',
                $srcValueObject->getName()
            );
            $srcService->outputBlue($welcome);
        }
    }


    public function pageAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $console = $this->getServiceLocator()->get('Console');

        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $create     = $request->getParam('create', null);
        $delete     = $request->getParam('delete', null);


        $controller = $request->getParam('controllerPage', null);
        $invokable  = $request->getParam('invokablePage', null);

        $action     = $request->getParam('actionPage', null);

        if (!$controller || !$action) {
            return 'Controller or Action not found';
        }

        $route      = $request->getParam('routePage', null);
        $role      = $request->getParam('rolePage', null);

        /* @var $pageService \Gear\Service\PageService */
        $pageService     = $this->getPageService();

        if ($create) {
            $page = $pageService->create(
                array(
                    'controller' => $controller,
                    'action'     => $action,
                    'route'      => $route,
                    'role'       => $role,
                    'invokable'  => $invokable
                )
            );

            if ($page) {
                $console = $this->getServiceLocator()->get('Console');
                $console->writeLine("$page", ColorInterface::RESET, ColorInterface::BLUE);
            }


        } elseif ($delete) {
            return $$pageService->delete($page);
        } else {
            return 'No action executed'."\n";
        }
    }

    public function dbAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $table = $this->getRequest()->getParam('table', null);

        $dbService = $this->getDbService();

        $create = $dbService->create($table);

        return $dbService->outputBlue($create);
    }


    public function sqliteAction()
    {
        $request = $this->getRequest();

        $fromMysql  = $request->getParam('from-mysql');
        $fromSchema = $request->getParam('from-schema');

        $db         = $request->getParam('db');
        $dump       = $request->getParam('dump');
        $username   = $request->getParam('username', null);
        $password   = $request->getParam('password', null);

        /* @var $projectService \Gear\Service\ProjectService */
        $projectService = $this->getServiceLocator()->get('projectService');

        if ($fromMysql) {
            return $projectService->getSqliteFromMysql($db,$dump, $username, $password);
        } elseif ($fromSchema) {
            return $projectService->getSqliteFromSchema($db,$dump);
        } else {
            return 'No action can be provided for sqlite'."\n";
        }
    }

    public function mysqlAction()
    {

        $this->getEventManager()->trigger('console.pre', $this);

        $request = $this->getRequest();

        $fromSchema = $request->getParam('from-schema');

        $database   = $request->getParam('database', null);
        $username   = $request->getParam('username', null);
        $password   = $request->getParam('password', null);


        /* @var $projectService \Gear\Service\ProjectService */
        $projectService = $this->getProjectService();

        if ($fromSchema) {
            $mysql = $projectService->setUpMysql($database, $username, $password);
            return $mysql;
        } else {
            return 'No action can be provided for sqlite'."\n";
        }
    }

    public function aclAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $this->getEventManager()->trigger('dependsSecurity', $this);

        $acl     = $this->getAclService();
        return $acl->loadAcl();
    }


    public function loadAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $request    = $this->getRequest();
        /* @var $module \Gear\Service\Module\ModuleService */
        $module = $this->getModuleService();


        $unload      = $request->getParam('unload');

        if (!$unload) {
            $module->registerModule();

            return 'Modulo registrado com sucesso'."\n";
        } else {
            $module->unregisterModule();
            return 'Modulo desregistrado com sucesso'."\n";
        }

    }

    public function configAction()
    {
        $request    = $this->getRequest();


        $environment = $request->getParam('environment');
        $username    = $request->getParam('username');
        $password    = $request->getParam('password');
        $host        = $request->getParam('host');
        $database    = $request->getParam('database');
        $dbms        = $request->getParam('dbms');

        /* @var $project \Gear\Service\ProjectService */
        $project = $this->getServiceLocator()->get('projectService');

        $console = '';

        $console .= $project->setUpEnvironment($environment);
        $console .= $project->setUpGlobal($environment, $dbms, $database, $host);
        $console .= $project->setUpLocal($username, $password)."\n";

        return $console;
    }

    public function environmentAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $project = $this->getProjectService();

        $environment = $this->getRequest()->getParam('environment', '');

        if (in_array($environment, array('production', 'staging', 'development', 'testing'))) {
            return $project->setUpEnvironment($environment);
        } else {
            return sprintf('Can\'t set %s for environment', $environment);
        }
    }


    public function buildAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $module  = $this->getRequest()->getParam('module');

        if (empty($module)) {
            return 'Module not specified';
        }

        $build = $this->getRequest()->getParam('build');

        if (empty($build)) {
            return 'Build not specified';
        }

        /* @var $module \Gear\Service\Module\ModuleService */
        $module = $this->getBuildService();

        return $module->build($build, $this->getRequest()->getParam('domain'));
    }


    public function versionAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        return $this->getVersionService()->get()."\n";
    }

    public function newsAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        return $this->getVersionService()->getNews();
    }

    public function dumpAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $json = $this->getRequest()->getParam('json');
        $array = $this->getRequest()->getParam('array');


        if ($json === false && $array === false) {
            return 'Type not specified';
        }

        $module = $this->getModuleService();

        if ($json) {
            return $module->dump('json')."\n";
        }

        if ($array) {
            return $module->dump('array')."\n";
        }

        return ''."\n";
    }


    public function entityAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $project = $request->getParam('project', false);
        $path    = $request->getParam('path');
        $module  = $request->getParam('module');
        $prefix  = $request->getParam('table_prefix',false);

        if (empty($project)) {
            throw new \Exception('Project not specified');
        } elseif (empty($path)) {
            throw new \Exception('Path not specified');
        } elseif (empty($module)) {
            throw new \Exception('Module not specified');
        }

        $entityGear = new \Gear\Model\EntityGear();
        $entityGear->setConfig(new \Gear\Model\Configuration($project,$path,$module,'entity',$prefix));
        $entityGear->dbToAnnotations();
        $entityGear->ymlToEntity();
    }

    public function getModuleService()
    {
        if (!isset($this->moduleService)) {
            $this->moduleService = $this->getServiceLocator()->get('moduleService');
        }
        return $this->moduleService;
    }


    public function setAclService($aclService)
    {
        $this->aclService = $aclService;
        return $this;
    }

    public function getAclService()
    {
        if (!isset($this->aclService)) {
            $this->aclService = $this->getServiceLocator()->get('aclService');
        }
        return $this->aclService;
    }


    public function getPageService()
    {
        if (!isset($this->pageService)) {
            $this->pageService = $this->getServiceLocator()->get('pageService');
        }
        return $this->pageService;
    }

    public function setPageService($pageService)
    {
        $this->pageService = $pageService;
        return $this;
    }

    public function getVersionService()
    {
        if (!isset($this->versionService)) {
            $this->versionService = $this->getServiceLocator()->get('versionService');
        }
        return $this->versionService;
    }

    public function setVersionService($versionService)
    {
        $this->versionService = $versionService;
        return $this;
    }

    public function getDbService()
    {
        if (!isset($this->dbService)) {
            $this->dbService = $this->getServiceLocator()->get('dbService');
        }
        return $this->dbService;
    }

    public function setDbService($dbService)
    {
        $this->dbService = $dbService;
        return $this;
    }

    public function setModuleService($moduleService)
    {
        $this->moduleService = $moduleService;
        return $this;
    }

    public function setProjectService($projectService)
    {
        $this->projectService = $projectService;
        return $this;
    }

    public function getSrcService()
    {
        if (!isset($this->srcService)) {
            $this->srcService = $this->getServiceLocator()->get('srcService');
        }
        return $this->srcService;
    }

    public function getProjectService()
    {
        if (!isset($this->projectService)) {
            $this->projectService = $this->getServiceLocator()->get('projectService');
        }

        return $this->projectService;
    }


    public function getBuildService()
    {
        if (!isset($this->buildService)) {
            $this->buildService = $this->getServiceLocator()->get('buildService');
        }

        return $this->buildService;
    }

}
