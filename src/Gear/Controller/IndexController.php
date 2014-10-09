<?php
namespace Gear\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Gear\Model\ModuleGear;
use Gear\Model\EntityGear;

class IndexController extends AbstractActionController
{

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

        if (empty($project)) {
           return 'Project not specified';
        } elseif (empty($host)) {
           return 'Path not specified';
        }

        /* @var $projectService \Gear\Service\ProjectService */
        $projectService = $this->getServiceLocator()->get('projectService');
        return $projectService->create($project, $host);
    }
    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function moduleAction()
    {
        $request    = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

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

    public function srcAction()
    {
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

        $type = $request->getParam('type');

        if (empty($type) || ($type != 'json' && $type != 'array')) {
            return 'Type not specified';
        }

        $module = $this->getServiceLocator()->get('moduleService');
        echo $module->dump($type)."\n";
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    public function pageAction()
    {

    }

    public function dbAction()
    {

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
