<?php
namespace Gear\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;

class SchemaListener implements ListenerAggregateInterface
{
    protected $listeners = array();

    public function attach(EventManagerInterface $events)
    {
        $sharedEvents      = $events->getSharedManager();
        $this->listeners[***REMOVED*** = $events->attach('doTest', array($this, 'insertIntoJson'));
        //$this->listeners[***REMOVED*** = $events->attach('doTest', array($this, 'doTwoEvent'));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index***REMOVED***);
            }
        }
    }

    public function insertIntoJson(EventInterface $event)
    {

        $target = $event->getTarget();
        $params = $event->getParams();


    }


    public function doTwoEvent(EventInterface $event)
    {
        echo 'tamo ae foda-se';
    }
}
