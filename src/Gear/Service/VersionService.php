<?php
namespace Gear\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Gear\Service\AbstractService;

class VersionService extends AbstractService implements EventManagerAwareInterface
{
    protected $event;

    public function getVersion()
    {
        $this->getEventManager()->trigger(__FUNCTION__.'pre', $this);

        $config = $this->getServiceLocator()->get('config');
        $console = $this->getServiceLocator()->get('console');

        $config = $this->getModule()->getConfigFolder();

        $moduleConfig = require __DIR__.'/../../../config/module.config.php';

        $console->writeLine($moduleConfig['version'***REMOVED***, 0, 3);

        $this->getEventManager()->trigger(__FUNCTION__.'post', $this);
    }

    public function getNews()
    {
        $this->getEventManager()->trigger(__FUNCTION__.'pre', $this);

        $version = 'Gear was made from a dreamer, to dreamers';

        $config = $this->getServiceLocator()->get('config');
        $console = $this->getServiceLocator()->get('console');
        $console->writeLine($version, 0, 3);

        $this->getEventManager()->trigger(__FUNCTION__.'post', $this);
    }


    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class(),
        ));
        $this->event = $events;
        return $this;
    }

    public function getEventManager()
    {
        if (null === $this->event) {
            $this->setEventManager(new EventManager());
        }
        return $this->event;
    }
}
