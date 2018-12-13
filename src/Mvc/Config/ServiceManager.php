<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\AbstractConfigManager;
use Gear\Schema\Schema\SchemaServiceTrait;
use Gear\Schema\Src\Src;

class ServiceManager extends AbstractConfigManager
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

        $this->file[$service***REMOVED***[$this->getServiceName($src)***REMOVED*** = $this->getServiceCallable($src);

        $this->getArrayService()->arrayToFile(
            $this->getModule()->getConfigExtFolder().'/servicemanager.config.php',
            $this->file
        );
    }

    /**
     * Retorna o Nome que o ServiceManager deve usar para localizar a classe.
     */
    public function getServiceName(Src $src)
    {
        if (empty($src->getNamespace())) {
            if ($src->getType() == 'SearchForm') {
                $type = 'Form\\Search';
            } elseif ($src->getType() == 'ViewHelper') {
                $type = 'View\\Helper';
            } else {
                $type = $src->getType();
            }

            return $this->getModule()->getModuleName().'\\'.$type.'\\'.$src->getName();
        }

        $namespace = ($src->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

        $namespace .= $src->getNamespace();

        return $namespace.'\\'.$src->getName();
    }

    /**
     * Retorna o objecto que o ServiceManager deve chamar.
     */
    public function getServiceCallable(Src $src)
    {
        $name = $src->getName();

        if ($src->isFactory()) {
            $name .= 'Factory';
        }

        if (empty($src->getNamespace())) {
            if ($src->getType() == 'SearchForm') {
                $type = 'Form\\Search';
            } elseif ($src->getType() == 'ViewHelper') {
                $type = 'View\\Helper';
            } else {
                $type = $src->getType();
            }

            return $this->getModule()->getModuleName().'\\'.$type.'\\'.$name;
        }

        $namespace = ($src->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

        $namespace .= $src->getNamespace();

        return $namespace.'\\'.$name;
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
