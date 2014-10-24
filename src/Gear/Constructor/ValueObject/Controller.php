<?php
namespace Gear\Constructor\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class Controller
{
    protected $name;

    protected $invokable;

    protected $actions = array();

    public function __construct(array $controller)
    {
        if (is_array($controller)) {
            $this->hydrate($controller);
        }

        /*
        if ($page instanceof \stdClass) {
            $this->setName($page->controller);
            $this->setInvokable($page->invokable);

            if (isset($page->actions) && count($page->actions) > 0) {
                foreach ($page->actions as $action) {

                    $page = new \Gear\ValueObject\Page($action);
                    $page->setController($this);
                    $this->addAction($page);


                }
            }
        } elseif (is_array($page)) {

        }
        */
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

    public function getInvokable()
    {
        return $this->invokable;
    }

    public function setInvokable($invokable)
    {
        $this->invokable = $invokable;
        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function setActions($actions)
    {
        $this->actions = $actions;
        return $this;
    }
}
