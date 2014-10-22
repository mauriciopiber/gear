<?php
/**
 *
 * @author piber
 * Um serviço é o ítem mais importante do DDD.
 * Um serviço precisa ser testado com TDD.
 * Um serviço não possui interface então não precisa ser testado com codeception.
 * Um serviço pode extender outro serviço.
 * Um serviço precisa ser adicionado ao invokables do Module.php ao final do processo.
 *
 */
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class ServiceService extends AbstractJsonService
{
    public function getServiceManagerFile()
    {
        return $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext/servicemanager.config.php';
    }

    public function getLocation()
    {
        return $this->getConfig()->getSrc().'/Service';
    }

    public function hasAbstract()
    {
        if (!is_file($location.'/AbstractService.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function create($options)
    {
        $this->saveJsonBySrc($options);

        $this->updateServiceManager();

        $location = $this->getLocation();

        if (!is_file($location.'/AbstractService.php')) {
            $this->getAbstract();
        }

        $class = $options->getName();
        $extends = (null !== $options->getExtends()) ? $options->getExtends() : 'AbstractService';

        $this->createFileFromTemplate(
            'src/emptyService',
            array(
                'class'   => $class,
                'extends' => $extends,
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'.php',
            $location
        );

        $this->createFileFromTemplate(
            'test/emptyService',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'Test.php',
            $this->getModule()->getTestServiceFolder()
        );
    }

    public function delete()
    {
        throw new \Exception('Not implemented yet');
    }

    public function getAbstract()
    {
        $this->createFileFromTemplate(
            'src/abstractService',
            array(
                'module' => $this->getConfig()->getModule()
            ),
            'AbstractService.php',
            $this->getConfig()->getSrc() . '/Service/'
        );
        echo 'getAbstract from ServiceService called'."\n";
    }


}
