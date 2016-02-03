<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;

class ServiceManager extends AbstractJsonService
{

    public function mergeFromDb(\Gear\ValueObject\Db $db)
    {
        $this->db = $db;
        $this->mergeServiceManagerConfig();
    }

    public function mergeFromSrc(\Gear\ValueObject\Src $src)
    {
        $this->src = $src;
        $this->triggerMergeServiceManager();
    }


    public function triggerMergeServiceManager()
    {
        $serviceManager = new \Gear\Config\ServiceManager($this->getModule());
        $serviceManager->extractServiceManagerFromSrc($this->src);

        if (!isset($this->serviceManagerFile[$serviceManager->getPattern()***REMOVED***)) {
            $this->serviceManagerFile[$serviceManager->getPattern()***REMOVED*** = [***REMOVED***;
        }

        if (array_key_exists($serviceManager->getCallable(), $this->serviceManagerFile['invokables'***REMOVED***)) {
            return;
        }

        $data = $serviceManager->getArray();

        if ($serviceManager->getPattern() == 'invokables') {

            $this->serviceManagerFile['invokables'***REMOVED***[sprintf('%s\%s\%s', $this->getModule()->getModuleName(), $this->src->getType(), $this->src->getName())***REMOVED*** =
                sprintf('%s\%s\%s', $this->getModule()->getModuleName(), $this->src->getType(), (isset($data['invokables'***REMOVED***[0***REMOVED***['aliase'***REMOVED***) ? $data['invokables'***REMOVED***[0***REMOVED***['aliase'***REMOVED*** : $this->src->getName()));

             $this->arrayToFile($this->getModule()->getConfigExtFolder().'/servicemanager.config.php', $this->serviceManagerFile);

             return;
        }

        if ($serviceManager->getPattern() == 'factories') {
             $this->serviceManagerFile['factories'***REMOVED***[$data['factories'***REMOVED***[0***REMOVED***['callable'***REMOVED******REMOVED*** = $data['factories'***REMOVED***[0***REMOVED***['object'***REMOVED***;
             $this->arrayToFile($this->getModule()->getConfigExtFolder().'/servicemanager.config.php', $this->serviceManagerFile);
             return;
        }

    }

    public function mergeServiceManagerConfig()
    {
        $this->serviceManagerFile = require $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';

        if ($this->src !== null) {
            $this->triggerMergeServiceManager();
        }

        if ($this->db !== null) {
            $srcs = $this->getGearSchema()->getAllSrcByDb($this->db);

            foreach ($srcs as $src) {
                $this->src = $src;
                $this->triggerMergeServiceManager();
            }
        }

        return;



        $srcs = $this->getGearSchema()->__extract('src');

        $controllers = [***REMOVED***;

        foreach ($srcs as $src) {

            $srcObject = new \Gear\ValueObject\Src($src);

            $serviceManager = new \Gear\Config\ServiceManager($this->getModule());
            $serviceManager->extractServiceManagerFromSrc($srcObject);

            $controllers = array_merge_recursive($serviceManager->getArray(), $controllers);
        }

        $this->createFileFromTemplate(
            'template/config/servicemanager.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'factories' => (isset($controllers['factories'***REMOVED***) && count($controllers['factories'***REMOVED*** >0) ? $controllers['factories'***REMOVED*** : array()),
                'invokables' => (isset($controllers['invokables'***REMOVED***) && count($controllers['invokables'***REMOVED***>0) ? $controllers['invokables'***REMOVED*** : array())
            ),
            'servicemanager.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getServiceManager()
    {
        return include $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';
    }



    public function getServiceManagerConfig($controllers = array())
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
