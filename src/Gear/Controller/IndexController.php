<?php
namespace Gear\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Gear\Model\ModuleGear;
use Gear\Model\EntityGear;

class IndexController extends AbstractActionController
{
    protected $moduleService;

    protected $projectService;

    protected $pageService;

    public function projectAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $project = $request->getParam('project', null);
        $host    = $request->getParam('host', null);
        $git     = $request->getParam('git', null);

        if (empty($project)) {
           return 'Project not specified';
        } elseif (empty($host) && $request->getParam('create', null)) {
           return 'Path not specified';
        } elseif (empty($git) && $request->getParam('create', null)) {
            return 'Git not specified';
        }

        /* @var $projectService \Gear\Service\ProjectService */
        $projectService = $this->getServiceLocator()->get('projectService');

        $create     = $request->getParam('create', null);
        $delete     = $request->getParam('delete', null);

        if ($create) {
            return $projectService->create($project, $host, $git);
        } elseif ($delete) {
            return $projectService->delete($project);
        } else {
            return 'No action provided to \Gear\Service\ProjectService';
        }
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
        $request = $this->getRequest();

        $fromSchema = $request->getParam('from-schema');

        $database   = $request->getParam('database', null);
        $username   = $request->getParam('username', null);
        $password   = $request->getParam('password', null);

        /* @var $projectService \Gear\Service\ProjectService */
        $projectService = $this->getServiceLocator()->get('projectService');

        if ($fromSchema) {
            return $projectService->getMysql($database, $username, $password);
        } else {
            return 'No action can be provided for sqlite'."\n";
        }
    }

    public function aclAction()
    {
        $this->getEventManager()->trigger('dependsSecurity', $this);

        $request = $this->getRequest();

        if (!$request instanceof \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $acl     = $this->getAclService();
        return $acl->loadAcl();
    }
    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function moduleAction()
    {
        $this->getEventManager()->trigger('init', $this);

        $request    = $this->getRequest();

        $moduleName = $request->getParam('module');
        $create     = $request->getParam('create', null);
        $delete     = $request->getParam('delete', null);

        $module     = $this->getModuleService();

        if (!$moduleName) {
            return 'Module not specified'."\n";
        } elseif ($create) {
            return $module->createEmptyModule($request->getParam('build', null));

        } elseif ($delete) {
            $module->delete();

            return sprintf('Module %s deleted.', $moduleName)."\n";
        } else {
            return 'No action executed'."\n";
        }
    }

    public function loadAction()
    {
        $this->getEventManager()->trigger('init', $this);
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

    public function migrateAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $migrate = $this->getServiceLocator()->get('migrateService');

        $environment = $request->getParam('environment');
        $username    = $request->getParam('username');
        $password    = $request->getParam('password');
        $dbms        = $request->getParam('dbms');
        $dbname      = $request->getParam('dbname');

        return $migrate->migrate($environment, $username, $password, $dbms, $dbname);
    }

    public function environmentAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $migrate = $this->getServiceLocator()->get('migrateService');

        $environment = $request->getParam('environment', '');

        if (in_array($environment, array('production', 'staging', 'development', 'testing'))) {
            return $migrate->setEnvironment($environment);
        } else {
            return sprintf('Can\'t set %s for environment', $environment);
        }
    }

    public function srcAction()
    {
        $this->getEventManager()->trigger('init', $this);

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

        $srcValueObject = new \Gear\ValueObject\Src();
        $srcValueObject->setType($type);
        $srcValueObject->setName($name);

        $srcService = $this->getSrcService();
        $srcService->setSrcValueObject($srcValueObject);

        return $srcService->factory();
    }

    public function buildAction()
    {
        $this->getEventManager()->trigger('init', $this);

        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $module  = $request->getParam('module');

        if (empty($module)) {
            return 'Module not specified';
        }

        $build = $request->getParam('build');

        if (empty($build)) {
            return 'Build not specified';
        }

        /* @var $module \Gear\Service\Module\ModuleService */
        $module = $this->getBuildService();

        return $module->build($build);
    }


    public function versionAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        return '0.1.0'."\n";
    }

    public function newsAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $version = 'Gear was made from a dreamer, to dreamers'."\n";

        $version .= 'Expected for version 0.1.0'."\n";
        $version .= '- Creating a module from scratch working on Continous Integration, with Index Action'."\n";
        $version .= '- Removing a module from application'."\n";
        $version .= '- Module already on bitbucket'.
        $version .= '- Composer ready to be used on anothers applications'."\n";
        $version .= '- Create a basic module with a contact form from scratch for bitbucket and continous integration'."\n";

        $version .= 'Expected for version 0.2.0'."\n";
        $version .= '- Create a full crud from one table for a module with continuous integration ready.'."\n";

        return $version;
    }

    public function getModuleService()
    {
        if (!isset($this->moduleService)) {
            $this->moduleService = $this->getServiceLocator()->get('moduleService');
        }
        return $this->moduleService;
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


    public function getBuildService()
    {
        if (!isset($this->buildService)) {
            $this->buildService = $this->getServiceLocator()->get('buildService');
        }

        return $this->buildService;
    }

    public function dumpAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $json = $request->getParam('json');
        $array = $request->getParam('array');


        if ($json === false && $array === false) {
            return 'Type not specified';
        }

        $module = $this->getServiceLocator()->get('moduleService');

        if ($json) {
            return $module->dump('json')."\n";
        }

        if ($array) {
            return $module->dump('array')."\n";
        }

        return "\n";



    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    public function pageAction()
    {

        $this->getEventManager()->trigger('init', $this);

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
            return $pageService->create(
                array(
            	    'controller' => $controller,
                    'action'     => $action,
                    'route'      => $route,
                    'role'       => $role,
                    'invokable'  => $invokable
                 )
            );
        } elseif ($delete) {
            return $$pageService->delete($page);
        } else {
            return 'No action executed'."\n";
        }
    }

    public function dbAction()
    {
        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Função responsável por excluir completamente um módulo criado anteriormente, não é possível voltar atrás.
     * @throws \RuntimeException

    public function gearmoduledeleteAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $module  = $request->getParam('module');

        if (empty($module)) {
            throw new \Exception('Module not specified');
        }


        $moduleGear = $this->getServiceLocator()->get('moduleService');
        $moduleGear->setConfig(new \Gear\ValueObject\Config\Config($module,'entity',null));
        $moduleGear->delete();

        return 'Módulo deletado com sucesso'."\n";
    }
    */

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

}
