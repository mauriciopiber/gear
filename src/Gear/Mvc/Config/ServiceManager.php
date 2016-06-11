<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Src\Src;

class ServiceManager extends AbstractJsonService implements ModuleManagerInterface, ServiceManagerInterface
{
    use SchemaServiceTrait;


    public function create(Src $src)
    {
        $this->src = $src;

        $this->file = require $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';

        if (!isset($this->file[$src->getService()***REMOVED***)) {
            $this->file[$src->getService()***REMOVED*** = [***REMOVED***;
        }

        $this->file[$src->getService()***REMOVED***[$this->getServiceName($src)***REMOVED*** = $this->getServiceCallable($src);

        $this->getArrayService()->arrayToFile(
            $this->getModule()->getConfigExtFolder().'/servicemanager.config.php',
            $this->file
        );

    }

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

        if ($src->getService() == 'factories') {
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

    public function module(array $controllers)
    {
        $this->getFileCreator()->createFile(
            'template/module/config/servicemanager.empty.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'controllers' => $controllers
            ),
            'servicemanager.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
