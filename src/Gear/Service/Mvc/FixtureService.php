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

class FixtureService extends AbstractJsonService
{
    public function create($src)
    {


        $db = $src->getDb();

        //var_dump($src);die();

        $this->createFileFromTemplate(
            'template/src/fixture/default.phtml',
            array(
                'name'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getFixtureFolder()
        );
        return;
    }
}
