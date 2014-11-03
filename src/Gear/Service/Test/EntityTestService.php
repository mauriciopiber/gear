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
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class EntityTestService extends AbstractJsonService
{
    public function create($src)
    {

    }


    public function introspectFromTable($table)
    {
        $class = $this->str('class', $table->getName());

        $this->createFileFromTemplate(
            'template/test/unit/entity/full.entity.phtml',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'Test.php',
            $this->getModule()->getTestEntityFolder()
        );
    }
}
