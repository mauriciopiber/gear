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
use Gear\Creator\CodeTrait;

class ValueObjectService extends AbstractJsonService
{
    use CodeTrait;
    use ValueObjectTestServiceTrait;

    public function create($src)
    {
        $this->src = $src;
        $this->getValueObjectTestService()->createTest($this->src);

        $this->getFileCreator()->createFile(
            'template/module/mvc/value-object/src.phtml',
            [
                'constructor' => $this->getCode()->getConstructor($this->src),
                'uses'        => $this->getCode()->getUse($this->src),
                'classDocs'   => $this->getCode()->getClassDocs($this->src),
                'namespace'   => $this->getCode()->getNamespace($this->src),
                'extends'     => $this->getCode()->getExtends($this->src),
                'class'       => $this->src->getName(),
                'abstract'    => $this->src->getAbstract(),
                'module'      => $this->getModule()->getModuleName()
            ***REMOVED***,
            $this->src->getName().'.php',
            $this->getCode()->getLocation($this->src)
        );
    }
}
