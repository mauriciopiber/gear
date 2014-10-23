<?php
namespace Gear\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Gear\Service\AbstractService;

class VersionService extends AbstractService implements EventManagerAwareInterface
{
    protected $event;

    public function get()
    {
        $config = $this->getServiceLocator()->get('config');
        return $config['version'***REMOVED***."\n";
    }

    public function getNews()
    {

        $version = 'Gear was made from a dreamer, to dreamers'."\n";

        $version .= 'Expected for version 0.1.0'."\n";
        $version .= '- Creating a module from scratch working on Continous Integration, with Index Action'."\n";
        $version .= '- Removing a module from application'."\n";
        $version .= '- Module already on bitbucket'.
        $version .= '- Composer ready to be used on anothers applications'."\n";
        $version .= '- Create a basic module with a contact form from scratch for bitbucket and continous integration'."\n";

        $version .= 'Expected for version 0.2.0'."\n";
        $version .= '- Create a full crud from one table for a module with continuous integration ready.'."\n";
        return $version;
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
