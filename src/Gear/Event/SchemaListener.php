<?php
namespace Gear\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;

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


        $this->listeners[***REMOVED*** = $events->attach('gear.pos', array($this, 'outputCommandLine'));
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
        $serviceLocator = $event->getTarget()->getServiceLocator();

        if ($event->getTarget()->getRequest()->getParam('acl')) {


            $aclService = $serviceLocator->get('GearAcl\Service\AclService');
            $aclService->createAclFromPages();

            $cacheService = $serviceLocator->get('cacheService');
            $cacheService->renewMemcached();

        }

        if ($event->getTarget()->getRequest()->getParam('cache')) {

            if ($event->getTarget()->getRequest()->getParam('action') !== 'renew-cache') {
                $cacheService = $serviceLocator->get('cacheService');
                $cacheService->renewFileCache();
            }
        }

        if ($event->getTarget()->getRequest()->getParam('memcached')) {

            if ($event->getTarget()->getRequest()->getParam('action') !== 'renew-cache') {
                $cacheService = $serviceLocator->get('cacheService');
                $cacheService->renewMemcached();
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
