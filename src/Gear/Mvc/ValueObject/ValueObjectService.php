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
namespace Gear\Mvc\ValueObject;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\ValueObject\ValueObjectTestServiceTrait;

class ValueObjectService extends AbstractJsonService
{
    use ValueObjectTestServiceTrait;

    public function create($src)
    {
        $this->getValueObjectTestService()->createTest($src);

        $this->getFileCreator()->createFile(
            'template/module/mvc/value-object/src.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $src->getName().'.php',
            $this->getModule()->getValueObjectFolder()
        );
    }
}
