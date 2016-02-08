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

    public function getMessageById($messageId)
    {
        $config = $this->serviceLocator->get('config');

        if (!isset($config['console_messages'***REMOVED***[$messageId***REMOVED***)) {
            throw new \Gear\Exception\OutputMessageNotFoundException();
        }

        $messageTemplate = $config['console_messages'***REMOVED***[$messageId***REMOVED***;

        return $messageTemplate;
    }


    public function outputCommandLine(EventInterface $event)
    {
        static::$lastRequestTime = microtime(true);

        $this->serviceLocator = $event->getTarget()->getServiceLocator();

        $params          = $event->getParams();
        $messageId       = $params['message'***REMOVED***;
        $messageTemplate = $this->getMessageById($messageId);

        $extra  = [***REMOVED***;

        if (isset($params['params'***REMOVED***)) {
            foreach ($params['params'***REMOVED*** as $param) {
                $extra[***REMOVED*** = $event->getTarget()->getRequest()->getParam($param);
            }
        }

        $module  = $event->getTarget()->getRequest()->getParam('module');
        if ($module) {
            $extra[***REMOVED*** = $module;
        }

        $project  = $event->getTarget()->getRequest()->getParam('project');
        if ($project) {
            $extra[***REMOVED*** = $project;
        }

        $date    = new \DateTime('now');

        $message = vsprintf($messageTemplate, array_merge($extra, array($date->format('d/m/Y H:i:s'))));

        $service = $this->serviceLocator->get('consoleService');
        $service->output("\n", ColorInterface::WHITE, ColorInterface::NORMAL);
        $service->output($message, 0, ColorInterface::RED);
    }

    public function outputCommandLineEndMessage(EventInterface $event)
    {
        $serviceLocator = $event->getTarget()->getServiceLocator();

        $config = $serviceLocator->get('config');

        $params = $event->getParams();

        $timeElapsed = microtime(true) - static::$lastRequestTime;

        $messageTemplate = $config['console_messages'***REMOVED***['finished'***REMOVED***;

        $date    = new \DateTime('now');

        $message = sprintf($messageTemplate, round($timeElapsed, 3), $date->format('d/m/Y H:i:s'));

        $service = $serviceLocator->get('consoleService');;

        $service->output($message, 0, ColorInterface::GREEN);

        if ($event->getTarget()->getRequest()->getParam('acl')) {


            $aclService = $serviceLocator->get('GearAcl\Service\AclService');
            $aclService->createAclFromPages();

            $cacheService = $serviceLocator->get('cacheService');
            $cacheService->renewMemcached();

        }

        if ($event->getTarget()->getRequest()->getParam('cache')) {

            $cacheService = $serviceLocator->get('cacheService');
            $cacheService->renewFileCache();

        }

        if ($event->getTarget()->getRequest()->getParam('memcached')) {

            $cacheService = $serviceLocator->get('cacheService');
            $cacheService->renewMemcached();

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
