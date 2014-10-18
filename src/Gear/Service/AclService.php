<?php
namespace Gear\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;

class AclService extends \Gear\Service\AbstractService implements EventManagerAwareInterface
{

    protected $loadedModules;
    protected $event;


    public function getProjectMetadata()
    {
        if (count($this->getLoadedModules()) > 0) {
            foreach ($this->getLoadedModules() as $module) {


                $baseFile = realpath(__DIR__.'/../../../../../module');

                if (!$baseFile) {
                    $baseFile = realpath(__DIR__.'/../../../../../../mauriciopiber');

                    if (!$baseFile) {
                        throw new \Exception('Error on project metadada configuration, check it out');
                    }

                    $baseFile = realpath(__DIR__.'/../../../../../');

                }

                echo $baseFile."\n";die();
                //onde está o arquivo, está no vendor ou no module?
                $baseModule = sprintf('%s/module/');


                $folder = \Gear\ValueObject\Project::getStaticFolder();

                echo $folder."\n";
                //module

                //vendor

            }
        }
die();
        $moduleFile = realpath(__DIR__.'/../../../schema/module.json');
        if ($moduleFile) {
            return \Zend\Json\Json::decode(file_get_contents($moduleFile));
        } else {
            return sprintf('Rule Service can\'t find it own module schema');
        }
    }

    public function loadAcl()
    {
        $this->getEventManager()->trigger('loadModules', $this);

        $meta = $this->getProjectMetadata();


        var_dump($this->getLoadedModules());
        return 'loaed' . "\n";
    }

    public function getLoadedModules()
    {
        return $this->loadedModules;
    }

    public function setLoadedModules($loadedModules)
    {
        $this->loadedModules = $loadedModules;
        return $this;
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
