<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;


class Controller extends AbstractHydrator
{

    protected $name;

    protected $service;

    protected $actions = array();

    protected $db;

    protected $columns;
    
    protected $type;
    
    public function createObjectFromPattern($name)
    {
        $strService = new \Gear\Service\Type\StringService();
        
        $callname = $strService->str('class', $name);
        
        $callname = str_replace('Controller', '', $callname);
        
        
        return '%s\\Controller\\'.$callname;
    }
    
    public function normalizeName($name)
    {
        $strService = new \Gear\Service\Type\StringService();
        
        $normalName = $strService->str('class', $name);
        $normalName = $strService->str('url', $normalName);
        $normalName = $strService->str('class', $normalName);
        $normalName = str_replace('-', '', $normalName);
        $normalName = $strService->str('class', $normalName);
        
        
        if (strlen($normalName) > 10 && strpos($normalName, 'Controller', strlen($normalName)-10) !== false) {
            
            $normalName = substr($normalName, 0, -10);
        }
      
        return $normalName.'Controller';
        
    }

    public function __construct($page)
    {
        
        $page['name'***REMOVED*** = $this->normalizeName($page['name'***REMOVED***);
    
        parent::__construct($page);
        
        
        if (empty($page['object'***REMOVED***)) {
            $page['object'***REMOVED*** = $this->createObjectFromPattern($page['name'***REMOVED***);
        }
        
        $this->service = new \Gear\ValueObject\ServiceManager(array(
            'object' => $page['object'***REMOVED***,
            'service'  => (isset($page['service'***REMOVED***) ? $page['service'***REMOVED*** : 'invokables')
        ));
        
        
        
        if (isset($page['actions'***REMOVED***) && is_array($page['actions'***REMOVED***)) {
            foreach ($page['actions'***REMOVED*** as $actionArray) {
                $this->actions[***REMOVED*** = new \Gear\ValueObject\Action($actionArray);
            }
        } else {
            $this->actions = array();
        }

        if (isset($page['db'***REMOVED***) && $page['db'***REMOVED*** !== '') {
            $db = new \Gear\ValueObject\Db(array('table' => $page['db'***REMOVED***));
            $this->db = $db;
        }

    }

    public function getNameOff()
    {
        return str_replace('Controller', '', $this->getName());
    }

    public function getDependency()
    {
        $controllerDependency =  [***REMOVED***;

        foreach ($this->actions as $action) {

            if (!in_array($action->getDependency(), $controllerDependency)) {
                $controllerDependency[***REMOVED*** = $action->getDependency();
            }

        }

        return $controllerDependency;
    }

    public function hasDependency()
    {
        if (count($this->getDependency()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getIndexController()
    {
        return array(
            'name' => 'IndexController',
            'service' => 'invokables',
            'object' => '%\Controller\Index'
        );
    }

    public function getInputFilter()
    {
        $name = new Input('name');
        $name->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($name);


        return $inputFilter;
    }

  /*   public function filter()
    {
        $toClass = new \Zend\Filter\FilterChain();

        $toClass
        ->attach(new \Zend\Filter\Word\DashToCamelCase())
        ->attach(new \Zend\Filter\Word\SeparatorToCamelCase())
        ->attach(new \Zend\Filter\Word\UnderscoreToCamelCase());

        $name = $toClass->filter($this->getName());

        $alpha = new \Zend\Filter\FilterChain();
        $alpha->attachByName('alpha');



        $serviceManager = $this->getService();

        $serviceManagerFix = $serviceManager->filter();

        //$service = $alpha->filter($this->getService())



        return new Controller(array(
            'name' => $name
        ));
    }
 */
    public function export()
    {
        $actionToExport = [***REMOVED***;

        foreach ($this->actions as $action) {

            $actionToExport[***REMOVED*** = $action->export();
        }

        if ($this->getDb() instanceof \Gear\ValueObject\Db) {
            $db = $this->getDb()->getTable();
        } elseif ($this->getDb() != '' && strlen($this->getDb())>3) {
            $db = $this->getDb();
        } else {
            $db = null;
        }

        return array(
            'name' => $this->getName(),
            'object' => $this->getService()->getObject(),
            'service' => $this->getService()->getService(),
            'actions' => $actionToExport,
            'db' => $db,
            'type' => $this->getType()
        );
    }


    public function arrayFlatten($array) {
        if (!is_array($array)) {
            return array();
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->arrayFlatten($value));
            }
            else {
                $result[$key***REMOVED*** = $value;
            }
        }
        return $result;
    }

    public function getPage($controller, $action)
    {
        return $this->action[$controller***REMOVED***[$action***REMOVED***;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function getAction()
    {
        return $this->actions;
    }

    public function addAction($action)
    {
        $this->actions[***REMOVED*** = $action;
        return $this;
    }
    

    public function getType() {
        return $this->type;
    }
    
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function getDb() {
        return $this->db;
    }

    public function setDb($db) {
        $this->db = $db;
        return $this;
    }

    public function getColumns() {
        return $this->columns;
    }

    public function setColumns($columns) {
        $this->columns = $columns;
        return $this;
    }

}
