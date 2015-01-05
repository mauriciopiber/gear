<?php
namespace Gear\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Zend\Console\ColorInterface;

class SchemaListener implements ListenerAggregateInterface
{
    protected $listeners = array();
    protected static $instance;
    protected static $lastRequestTime;

    public function attach(EventManagerInterface $events)
    {
        $sharedEvents      = $events->getSharedManager();
        $this->listeners[***REMOVED*** = $events->attach('createInstance', array($this, 'setWorkingInstance'));
        $this->listeners[***REMOVED*** = $events->attach('getInstance', array($this, 'getWorkingInstance'));
        $this->listeners[***REMOVED*** = $events->attach('gear.pre', array($this, 'outputCommandLine'));
        $this->listeners[***REMOVED*** = $events->attach('gear.pos', array($this, 'outputCommandLineEndMessage'));

    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index***REMOVED***);
            }
        }
    }


    public function outputCommandLine(EventInterface $event)
    {
        static::$lastRequestTime = microtime(true);

        $serviceLocator = $event->getTarget()->getServiceLocator();

        $config = $serviceLocator->get('config');

        $params = $event->getParams();

        $messageId = $params['message'***REMOVED***;


        if (!isset($config['console_messages'***REMOVED***[$messageId***REMOVED***)) {
            throw new \Gear\Exception\OutputMessageNotFoundException();
        }

        $messageTemplate = $config['console_messages'***REMOVED***[$messageId***REMOVED***;


        $module  = $event->getTarget()->getRequest()->getParam('module');
        $project = $config['project'***REMOVED***['name'***REMOVED***;
        $date    = new \DateTime('now');




        $message = sprintf($messageTemplate, $module, $project, $date->format('d/m/Y H:i:s'));

        $service = $params['service'***REMOVED***;

        $service->output($message, 0, ColorInterface::GREEN);
    }

    public function outputCommandLineEndMessage(EventInterface $event)
    {

        $serviceLocator = $event->getTarget()->getServiceLocator();

        $config = $serviceLocator->get('config');

        $params = $event->getParams();


        $timeElapsed = microtime(true) - static::$lastRequestTime;

        $messageTemplate = $config['console_messages'***REMOVED***['finished'***REMOVED***;

        $date    = new \DateTime('now');

        $message = sprintf($messageTemplate, $timeElapsed, $date->format('d/m/Y H:i:s'));

        $service = $params['service'***REMOVED***;

        $service->output($message, 0, ColorInterface::BLUE);

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
