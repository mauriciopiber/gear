<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\AbstractConfigManager;
use Gear\Schema\Schema\SchemaServiceTrait;
use Gear\Schema\Src\Src;
use Gear\Mvc\Config\AbstractConfigManagerInterface;

class ServiceManager extends AbstractConfigManager implements
  AbstractConfigManagerInterface
{
    use SchemaServiceTrait;


    public function create(Src $src)
    {
        $this->src = $src;

        $this->file = require $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';

        $service = ($src->getService()) ? $src->getService() : 'invokables';

        if (!isset($this->file[$service***REMOVED***)) {
            $this->file[$service***REMOVED*** = [***REMOVED***;
        }

        $name = $this->code->getServiceManagerName($src);
        $call = $this->code->getServiceManagerCall($src);

        $this->file[$service***REMOVED***[$name***REMOVED*** = $call;

        $this->getArrayService()->arrayToFile(
            $this->getModule()->getConfigExtFolder().'/servicemanager.config.php',
            $this->file
        );
    }

    public function getServiceManager()
    {
        return include $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';
    }

    public function module()
    {
        $this->getFileCreator()->createFile(
            'template/module/config/servicemanager.empty.phtml',
            array(),
            'servicemanager.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
