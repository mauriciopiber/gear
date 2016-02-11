<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Src\Src;

class ServiceManager extends AbstractJsonService implements ModuleManagerInterface, ServiceManagerInterface
{
    use SchemaServiceTrait;

    public function mergeFromSrc(Src $src)
    {
        $this->src = $src;
        $this->triggerMergeServiceManager();
    }

    public function get(Src $src)
    {
        throw new \Exception('Implementar');
    }

    public function delete(Src $src)
    {
        throw new \Exception('Implementar');
    }


    public function create(Src $src)
    {
        $this->src = $src;

        $this->serviceManagerFile = require $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';

        $serviceManager = new \Gear\Mvc\Config\ServiceManagerResolver($this->getModule());
        $serviceManager->extractServiceManagerFromSrc($this->src);

        if (!isset($this->serviceManagerFile[$serviceManager->getPattern()***REMOVED***)) {
            $this->serviceManagerFile[$serviceManager->getPattern()***REMOVED*** = [***REMOVED***;
        }

        if (array_key_exists($serviceManager->getCallable(), $this->serviceManagerFile['invokables'***REMOVED***)) {
            return;
        }

        $data = $serviceManager->getArray();


        if ($serviceManager->getPattern() == 'invokables') {

            $this->serviceManagerFile['invokables'***REMOVED***[$serviceManager->getCallable()***REMOVED*** = $serviceManager->getObject();
            $this->arrayToFile($this->getModule()->getConfigExtFolder().'/servicemanager.config.php', $this->serviceManagerFile);

            return;
        }

        if ($serviceManager->getPattern() == 'factories') {
             $this->serviceManagerFile['factories'***REMOVED***[$data['factories'***REMOVED***[0***REMOVED***['callable'***REMOVED******REMOVED*** = $data['factories'***REMOVED***[0***REMOVED***['object'***REMOVED***;
             $this->arrayToFile($this->getModule()->getConfigExtFolder().'/servicemanager.config.php', $this->serviceManagerFile);
             return;
        }

    }

    public function getServiceManager()
    {
        return include $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';
    }

    public function module(array $controllers)
    {
        $this->createFileFromTemplate(
            'template/config/servicemanager.empty.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'controllers' => $controllers
            ),
            'servicemanager.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

}
