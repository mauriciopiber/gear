<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class Controller
{

    protected $name;

    protected $service;

    protected $actions = array();

    public function __construct($page)
    {
        if ($page instanceof \stdClass) {
            $this->setName($page->controller);
            $this->setService($page->service);

            if (isset($page->actions) && count($page->actions) > 0) {
                foreach ($page->actions as $action) {

                    $page = new \Gear\ValueObject\Page($action);
                    $page->setController($this);
                    $this->addAction($page);


                }
            }
        } elseif (is_array($page)) {
            $this->hydrate($page);
            $this->service = new \Gear\ValueObject\ServiceManager($page);
        }
    }

    public function export()
    {

        return array(
        	'name' => $this->getName(),
            'object' => $this->getService()->getObject(),
            'service' => $this->getService()->getService(),
            'actions' => $this->getAction()
        );
    }

    public function extract()
    {
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }

    public function hydrate(array $data)
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
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

    public function getAction()
    {
        return $this->arrayFlatten($this->actions);
    }

    public function addAction($action)
    {
        $this->actions[$action->getController()->getName()***REMOVED***[$action->getAction()***REMOVED*** = $action;
        return $this;
    }
}
