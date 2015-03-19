<?php
namespace Gear\Service;

use Zend\EventManager\EventManagerInterface;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class FixtureService extends \Gear\Service\AbstractService
{
    protected $loadedFixtures;

    protected $event;

    public function getLoadedFixtures()
    {
        return $this->loadedFixtures;
    }

    public function setLoadedFixtures($loadedFixtures)
    {
        $this->loadedFixtures = $loadedFixtures;
        return $this;
    }

    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class()
        ));
        $this->event = $events;
        return $this;
    }

    public function getEventManager()
    {
        if (null === $this->event) {
            $this->setEventManager(new \Zend\EventManager\EventManager());
        }
        return $this->event;
    }


    public function importProject()
    {

        $this->getEventManager()->trigger('loadFixtures', $this);

        $loader = new Loader();

        foreach ($this->getLoadedFixtures() as $fixture) {
            $loader->loadFromDirectory(realpath($fixture));
        }

        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'), $purger);
        $executor->execute($loader->getFixtures());


    }

}
