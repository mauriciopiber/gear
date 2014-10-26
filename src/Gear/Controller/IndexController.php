<?php
namespace Gear\Controller;

use Zend\Console\ColorInterface;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractConsoleController;
use Gear\Model\ModuleGear;
use Gear\Model\EntityGear;
use Zend\Console\Console;
use Zend\View\Model\ConsoleModel;
use Zend\Constructor\Controller as ControllerConstructor;
use Gear\Common\LogMessage;

/**
 * @since 2014-02-21
 */
class IndexController extends AbstractConsoleController
{
    protected $moduleService;

    protected $projectService;

    protected $pageService;

    protected $dbService;

    protected $srcService;

    protected $aclService;


    public function loopActivity($service, $data = array(), $serviceName = __FUNCITION__)
    {
        $result = null;

        $moduleName  = $this->getConfig()->getModule();
        $toDo   = $this->getRequest()->getParam('toDo', null);
        switch($toDo) {
        case 'create':
            $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, LogMessage::OK_CODE);
            $result = $service->create($data);
            break;
            case 'delete':
                $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::DESTROY), 0, LogMessage::DEST_CODE);
                $result = $service->delete($data);
                break;
            case 'setUpGlobal':
            $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, LogMessage::OK_CODE);
                $result = $service->setUpGlobal($data);
                break;
                case 'setUpLocal':
                $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, LogMessage::OK_CODE);
                $result = $service->setUpLocal($data);
                break;
    	case 'setUpEnvironment':
        	$service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, LogMessage::OK_CODE);
        	$result = $service->setUpEnvironment($data);
                break;
        }
        $this->loopResult($service, $result, $serviceName, true);
        return $result;
    }

    public function loopResult($service, $element, $serviceName, $destroy = false)
    {

        $parameter = array('id' => 1);
        $this->getEventManager()->trigger('eventName', $this, $parameter);

        $moduleName = $service->getConfig()->getModule();
        if ($element) {
            $code = ($destroy !== false) ? LogMessage::DEST_CODE : LogMessage::OK_CODE;
            $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::OK), 0, $code);
        } else {
            $code = ($destroy !== false) ? LogMessage::DEST_CODE : LogMessage::FAIL_CODE;
            $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::FAIL), 0,  $code);
        }
    }


    public function srcAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $request = $this->getRequest();
        $type = $request->getParam('type');

        if (empty($type)) {
            return 'Type not specified';
        }

        $name = $request->getParam('name');

        if (empty($name)) {
            return 'Name not specified';
        }

        $dependency = $request->getParam('dependency', null);

        $srcService = $this->getSrcService();

        $src = new \Gear\ValueObject\Src(array(
        	'name'       => $request->getParam('name'),
            'type'       => $request->getParam('type'),
            'dependency' => $request->getParam('dependency')
        ));

        $welcome = sprintf(
            'Criar Source %s do tipo %s para o módulo %s do projeto localizado na pasta %s/%s',
            $src->getName(),
            $src->getType(),
            $srcService->getConfig()->getModule(),
            \Gear\ValueObject\Project::getStaticFolder(),
            $srcService->getConfig()->getModule()
        );
        $srcService->output($welcome, 0, 12);
        $srcService->setSrcValueObject($src);

        $status = $srcService->create();

        if ($status) {
            $welcome = sprintf(
                'Source %s criado',
                $src->getName()
            );

            $srcService->output($welcome, 0, 11);
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
        $role       = $request->getParam('rolePage', null);

        /* @var $pageService \Gear\Service\Constructor\PageService */
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


        } elseif ($delete) {
            return $pageService->delete($page);
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

        if ($create) {
            $dbService->outputBlue(sprintf('Table %s geared for module %s!', $table, $dbService->getConfig()->getModule()));
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

        $this->getEventManager()->trigger('console.pre', $this);

        $request = $this->getRequest();

        $fromSchema = $request->getParam('from-schema');

        $database   = $request->getParam('database', null);
        $username   = $request->getParam('username', null);
        $password   = $request->getParam('password', null);


        /* @var $projectService \Gear\Service\ProjectService */
        $projectService = $this->getProjectService();

        $this->loopActivity($project, array('database' => $database, 'username' => $username, 'password' => $password), 'Mysql create database on kernel');
        return new ConsoleModel();
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
