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
        $this->listeners[***REMOVED*** = $events->attach('doTest', array($this, 'doEvent'));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index***REMOVED***);
            }
        }
    }

    public function doEvent(EventInterface $event)
    {
        $params = $event->getParams();

        echo sprintf('%s MAMA MIA VAI FUNCIONAR', $params['name'***REMOVED***)."\n";

    }
}
