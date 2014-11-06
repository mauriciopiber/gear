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
        return $this->getModule()->getSrcModuleFolder().'/Service';
    }

    public function hasAbstract()
    {
        if (!is_file($this->getLocation().'/AbstractService.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function introspectFromTable($table)
    {
        $location = $this->getLocation();

        if (!is_file($location.'/AbstractService.php')) {
            $this->getAbstract();
        }

        $src = $this->getGearSchema()->getSrcByDb($table, 'Service');

        $repository = str_replace($src->getType(), '', $src->getName()).'Repository';

        $class = $src->getName();

        $toEntity = $this->str('class', str_replace('Service', '', $class));

        $extends = 'AbstractService';

        if ($this->verifyImageDependency($toEntity)) {
            $imagemService = true;
        } else {
            $imagemService = false;
        }

        $this->createFileFromTemplate(
            'template/src/service/full.service.phtml',
            array(
                'imagemService' => $imagemService,
                'baseName' => $toEntity,
                'entity' => $toEntity,
                'class'   => $class,
                'extends' => $extends,
                'use' => $this->getClassService()->getUses($src),
                'attribute' => $this->getClassService()->getAttributes($src),
                'injection' => $this->getClassService()->getInjections($src),
                'module'  => $this->getConfig()->getModule(),
                'repository' => $repository
            ),
            $class.'.php',
            $this->getLocation()
        );
    }

    /**
     * @param \Gear\ValueObject\Src
     * @return boolean $status
     */
    public function create($options)
    {
        $location = $this->getLocation();

        if (!is_file($location.'/AbstractService.php')) {
            $this->getAbstract();
        }

        $class = $options->getName();
        $extends = (null !== $options->getExtends()) ? $options->getExtends() : 'AbstractService';


        $this->createFileFromTemplate(
            'template/src/service/src.service.phtml',
            array(
                'class'   => $class,
                'extends' => $extends,
                'use' => $this->getClassService()->getUses($options),
                'attribute' => $this->getClassService()->getAttributes($options),
                'injection' => $this->getClassService()->getInjections($options),
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'.php',
            $location
        );

        $this->createFileFromTemplate(
            'template/test/unit/service/src.service.phtml',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule(),
                'injection' => $this->getClassService()->getTestInjections($options),
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
            $this->getModule()->getSrcModuleFolder() . '/Service/'
        );
        $this->outputYellow('Criado arquivo AbstractService');
    }


}
