<?php
namespace Gear\ValueObject;

class Controller
{

    protected $name;

    protected $invokable;

    protected $action = array();

    public function __construct($page)
    {
        $this->setName($page->controller);
        $this->setInvokable($page->invokable);

        foreach ($page->actions as $action) {

            $page = new \Gear\ValueObject\Page($action);
            $page->setController($this);

            $this->addAction($page);
        }

    }

    public function arrayFlatten($array) {
        if (!is_array($array)) {
            return FALSE;
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

    public function getAction()
    {
        return $this->arrayFlatten($this->action);
    }

    public function addAction($action)
    {
        $this->action[$action->getController()->getName()***REMOVED***[$action->getAction()***REMOVED*** = $action;
        return $this;
    }
}
