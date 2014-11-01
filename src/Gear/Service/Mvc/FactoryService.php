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

class FactoryService extends AbstractJsonService
{
    public function getLocation()
    {
        return $this->getConfig()->getSrc().'/Factory';
    }

    public function hasAbstract()
    {
        if (is_file($this->getLocation().'/AbstractFactory.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function introspectFromTable($table)
    {

    }


    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->createFileFromTemplate(
                'template/src/factory/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractFactory.php',
                $this->getModule()->getFactoryFolder()
            );
        }
    }

    public function create($src)
    {

        $this->getAbstract();

        $this->createFileFromTemplate(
            'template/test/unit/factory/src.factory.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestFactoryFolder()
        );

        $this->createFileFromTemplate(
            'template/src/factory/src.factory.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getFactoryFolder()
        );
    }

}
