<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;

class ServiceTestService extends AbstractFixtureService
{
    public function introspectFromTable($table)
    {
        $this->loadTable($table);

        $src = $this->getGearSchema()->getSrcByDb($table, 'Service');

        $order = [***REMOVED***;
        $selectOneBy = [***REMOVED***;

        $this->setBaseArray(array(
            'method' => $this->tableName.'Service', 'module' => $this->getConfig()->getModule(), 'entityName' => $this->tableName
        ));

        $primaryKeyColumn   = $this->table->getPrimaryKeyColumns();
        $this->usePrimaryKey = true;

        $entityValues = $this->getValuesForUnitTest();


        $this->createFileFromTemplate(
            'template/test/unit/service/full.service.phtml',
            array(
                'serviceNameUline' => substr($this->str('var', $src->getName()), 0, 18),
                'serviceNameVar' => substr($this->str('var', $src->getName()), 0, 18),
                'serviceNameClass'   => $src->getName(),
                'class' => $this->str('class', str_replace('Service', '', $src->getName())),
                'module'  => $this->getConfig()->getModule(),
                'injection' => $this->getClassService()->getTestInjections($src),
                'oneBy' => $this->getSelectOneByForUnitTest(),
                'insertArray' => $entityValues->getInsertArray(),
                'updateArray' => $entityValues->getUpdateArray(),
                'insertAssert' => $entityValues->getInsertAssert(),
                'updateAssert' => $entityValues->getUpdateAssert()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestServiceFolder()
        );
    }
}
