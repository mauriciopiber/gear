<?php
namespace Gear\Controller;

use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Metadata\Metadata;
use Gear\Model\Schema;
use Gear\Model\Mock;
use Gear\Model\ModuleGear;
use Gear\Model\EntityGear;
use Zend\Form\Element\Checkbox;
use Gear\Form\SelectDbForm;
use Doctrine\DBAL\Schema\View;
use Gear\Form\SelectTableForm;
use Gear\Form\SelectYmlForm;
use FileTree\File;
use Gear\Model\MakeGear;
use Gear\Form\CreateModule;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;

class IndexController extends AbstractActionController
{
    public function versionAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
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

        echo $version;
    }

    public function buildAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
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

        /* @var $moduleGear \Gear\Service\Module\ModuleService */
        $moduleGear = $this->getServiceLocator()->get('moduleService');
        $moduleGear->setConfig(new \Gear\ValueObject\Config\Config($module,'entity',null));
        return $moduleGear->build($build);
    }


    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function moduleAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $module  = $request->getParam('module');

        if (empty($module)) {
            throw new \Exception('Module not specified');
        }

        // Check mode
        $mode = $request->getParam('mode', null);

        if (is_null($mode)) {
            return 'Mode is not specified';
        }

        $build     = $request->getParam('no-build');

        /* @var $moduleGear \Gear\Service\Module\ModuleService */
        $moduleGear = $this->getServiceLocator()->get('moduleService');
        $moduleGear->setConfig(new \Gear\ValueObject\Config\Config($module,'entity',null));
        $moduleGear->createEmptyModule($build);

        return 'Módulo criado com sucesso'."\n";
    }

    public function srcAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        /* @var $creator \Gear\Service\CreatorService */
        $creator = $this->getServiceLocator()->get('creatorService');

        if (!$creator->isValid()) {
            return $creator->getMessage();
        }

        $srcType = $request->getParam('srctype');

        if (empty($srcType)) {
            return 'Src Type not specified';
        }

        $mod    = $request->getParam('mod');

        if (empty($mod)) {
            return 'Mod not specified';
        }

        $options    = $request->getParam('options', '{}');
        echo $this->dance();
        echo $creator->src($mod, $srcType, $options);

    }

    public function dumpAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
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

        if (!$request instanceof  \Zend\Console\Request){
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

        if (!$request instanceof  \Zend\Console\Request){
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


    public function projectAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $project = $request->getParam('project', false);
        $path    = $request->getParam('path');

        if (empty($project)) {
            throw new \Exception('Project not specified');
        } elseif (empty($path)) {
            throw new \Exception('Path not specified');
        }

        $projectGear = new \Gear\Model\ProjectGear();
        $projectGear->setConfig(new \Gear\Model\Configuration($project, $path, null, array(), null));
        $projectGear->create();
    }
}
