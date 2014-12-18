<?php
namespace Gear\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;

class SchemaListener implements ListenerAggregateInterface
{
    protected $listeners = array();
    protected static $instance;

    public function attach(EventManagerInterface $events)
    {
        $sharedEvents      = $events->getSharedManager();
        $this->listeners[***REMOVED*** = $events->attach('createInstance', array($this, 'setWorkingInstance'));
        $this->listeners[***REMOVED*** = $events->attach('getInstance', array($this, 'getWorkingInstance'));

    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index***REMOVED***);
            }
        }
    }

    public function setWorkingInstance(EventInterface $event)
    {
        $target = $event->getTarget();
        $params = $event->getParams();
        self::$instance = $params['instance'***REMOVED***;
        return true;
    }


    public function getWorkingInstance(EventInterface $event)
    {
        $target = $event->getTarget();
        $params = $event->getParams();
        $target->setInstance(self::$instance);
    }


}
