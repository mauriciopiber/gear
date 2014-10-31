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

    public function __construct($page)
    {
        parent::__construct($page);

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
        return array(
        	'name' => $this->getName(),
            'object' => $this->getService()->getObject(),
            'service' => $this->getService()->getService(),
            'actions' => $actionToExport
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
}
