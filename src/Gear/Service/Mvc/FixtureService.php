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



        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');


        $columns = $metadata->getColumns($this->str('uline', $db));


        $arrayData = [***REMOVED***;

        $fixtureTime = 1;


        for ($iterator = 0; $iterator < 30; $iterator++) {

            $arrayData[***REMOVED*** = '            array('.PHP_EOL;

            foreach ($columns as $column) {

                if (in_array($this->str('uline', $column->getName()), \Gear\ValueObject\Db::excludeList())) {
                    continue;
                }




                $arrayData[***REMOVED*** = sprintf('                \'%s\' => \'%d%s\',', $this->str('var', $column->getName()), $iterator, $this->str('label', $column->getName())).PHP_EOL;
            }

            $arrayData[***REMOVED*** = '            ),'.PHP_EOL;
        }





        //criar um array com as informações básicas.

        //var_dump($src);die();

        $this->createFileFromTemplate(
            'template/src/fixture/default.phtml',
            array(
                'data'   => $arrayData,
                'name'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getFixtureFolder()
        );
        return;
    }
}
