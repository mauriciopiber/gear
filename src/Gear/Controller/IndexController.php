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
    /**
    * @var Doctrine\ORM\EntityManager
    */
    protected $em;

    public function getEntityManager()
    {
        if (null === $this->em) {
            $service = $this->getServiceLocator();
            $em = $service->get('doctrine.entitymanager.orm_default');
            $this->em = $em;
        }
        return $this->em;
    }

    public function gearAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }


        echo 'You just trigger Gear beta version'."\n";
    }


    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function gearcreatemoduleAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $module  = $request->getParam('module');

        if (empty($module)) {
            throw new \Exception('Module not specified');
        }



        /* @var $moduleGear \Gear\Service\Module\ModuleService */
        $moduleGear = $this->getServiceLocator()->get('moduleService');
        $moduleGear->setConfig(new \Gear\ValueObject\Config\Config($module,'entity',null));
        $moduleGear->createEmptyModule();

    }

    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function gearcreatepagesAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $project = $request->getParam('project', false);
        $path    = $request->getParam('path');
        $module  = $request->getParam('module');

        if (empty($project)) {
            throw new \Exception('Project not specified');
        } elseif (empty($path)) {
            throw new \Exception('Path not specified');
        } elseif (empty($module)) {
            throw new \Exception('Module not specified');
        }
        $moduleGear = $this->getServiceLocator()->get('module_gear');
        $moduleGear->setConfig(new \Gear\Model\Configuration($project,$path,$module,'entity',null));
        $moduleGear->createPages();
    }


    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function gearcreatelegoAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $project = $request->getParam('project', false);
        $path    = $request->getParam('path');
        $module  = $request->getParam('module');
        $piece   = $request->getParam('piece');
        $tables  = $request->getParam('table');
        $prefix  = $request->getParam('table_prefix',false);

        if (empty($project)) {
            throw new \Exception('Project not specified');
        } elseif (empty($path)) {
            throw new \Exception('Path not specified');
        } elseif (empty($module)) {
            throw new \Exception('Module not specified');
        } elseif (empty($piece)) {
            throw new \Exception('Piece not specified');
        }


        if($tables == false) {
            $tables = 'entity';
        } elseif(is_string($tables)) {
            if(preg_match('/,/',$tables)) {
                $tables = explode(',',$tables);
            } else {
                $tables = array($tables);
            }
        }

        $powerGear = $this->getServiceLocator()->get('power_gear');
        $powerGear->setConfig(new \Gear\Model\Configuration($project,$path,$module,$tables,$prefix,null,$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'),$this->getServiceLocator()));
        $powerGear->make($piece);
    }

    /**
     * Função responsável por criar as funcionalidades básicas dentro de um módulo especificado.
     * @throws \RuntimeException
     */
    public function gearcreatecrudAction()
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


        $moduleGear = $this->getServiceLocator()->get('module_gear');
        $moduleGear->setConfig(new \Gear\Model\Configuration($project,$path,$module,'entity',$prefix));
        $moduleGear->createModule();
    }


    public function gearcreateentitiesAction()
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


    public function gearcreateprojectAction()
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


    public function gearcreatefileAction()
    {
        $request = $this->getRequest();
        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }



        $project = $request->getParam('project', false);
        $path    = $request->getParam('path');
        $module  = $request->getParam('module');
        $file  = $request->getParam('file');
        $tables  = $request->getParam('table');
        $prefix  = $request->getParam('table_prefix',false);

        if (empty($project)) {
            throw new \Exception('Project not specified');
        } elseif (empty($path)) {
            throw new \Exception('Path not specified');
        } elseif (empty($module)) {
            throw new \Exception('Module not specified');
        } elseif (empty($file)) {
            throw new \Exception('File not specified');
        } elseif (empty($tables) && $file != 'Module') {
            throw new \Exception('Table not specified');
        }


        if($tables == false) {
            $tables = 'entity';
        } elseif(is_string($tables)) {
            if(preg_match('/,/',$tables)) {
                $tables = explode(',',$tables);
            } else {
                $tables = array($tables);
            }
        }

        $power = $this->getServiceLocator()->get('power_gear');
        $power->setConfig(new \Gear\Model\Configuration($project,$path,$module,$tables,$prefix,null,$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'),$this->getServiceLocator()));
        $power->make($file);

    }

    public function gearcreatecruduniqueAction()
    {
        $request = $this->getRequest();
        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $project  = $request->getParam('project', false);
        $path     = $request->getParam('path');
        $module   = $request->getParam('module');
        $tables    = $request->getParam('table',false);
        $prefix   = $request->getParam('table_prefix',false);
        $exclude  = $request->getParam('exclude',false);


        if (empty($project)) {
            throw new \Exception('Project not specified');
        } elseif (empty($path)) {
            throw new \Exception('Path not specified');
        } elseif (empty($module)) {
            throw new \Exception('Module not specified');
        } elseif (empty($tables)) {
            throw new \Exception('Table not specified');
        }

        $power = $this->getServiceLocator()->get('power_gear');
        $power->setConfig(new \Gear\Model\Configuration($project,$path,$module,$tables,$prefix,null,$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'),$this->getServiceLocator()));
        $power->empower($exclude);
    }


    public function addAction()
    {

        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $project    = $request->getParam('project', false);
        $module     = $request->getParam('module',false);
        $controller = $request->getParam('controllerTo',false);
        $action     = $request->getParam('actionTo',false);
        $role       = $request->getParam('role',false);


        $database = $this->getServiceLocator()->get('database_gear');
        $database->addRule($project,$module,$controller,$action,$role);

    }



    /**
     * Campos especiais devem ficar em um arquivo de configuração json.
     */

    public function importmanagerAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $project = $request->getParam('project', false);
        $path    = $request->getParam('path');
        $module  = $request->getParam('module');
        $prefix  = $request->getParam('table_prefix', false);

        $databaseGear = $this->getServiceLocator()->get('database_gear');
        $databaseGear->setConfig(new \Gear\Model\Configuration($project, $path, $module, 'entity', $prefix));
        $databaseGear->import();
    }

    public function rulemanagerAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $project = $request->getParam('project', false);
        $path    = $request->getParam('path');
        $module  = $request->getParam('module');
        $prefix  = $request->getParam('table_prefix',false);

        $databaseGear = $this->getServiceLocator()->get('database_gear');
        $databaseGear->setConfig(new \Gear\Model\Configuration($project,$path,$module,'entity',$prefix));
        $databaseGear->rule();
    }

    public function ruleclearAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $project = $request->getParam('project', false);
        $path    = $request->getParam('path');


        $databaseGear = $this->getServiceLocator()->get('database_gear');
        $databaseGear->setConfig(new \Gear\Model\Configuration($project,$path,null,'entity',false));
        $databaseGear->clearRules();
    }



    public function normalizedbAction()
    {
        $request = $this->getRequest();
        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $database = $this->getServiceLocator()->get('database_gear');

        $prefix  = $request->getParam('table_prefix',false);
        $exclude  = $request->getParam('table_exclude',false);


        if (strpos($prefix,',') !== false) {
            foreach(explode(',',$prefix) as $i => $v) {
                $database->checkNormalization($v,$exclude);
            }
        } else {

            $database->checkNormalization($prefix,$exclude);
        }

    }

    public function dropi18nAction()
    {

        $request = $this->getRequest();
        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $database = $this->getServiceLocator()->get('database_gear');

        $prefix  = $request->getParam('i18n_prefix','i18n');


        $database->dropi18n($prefix);


    }




}
