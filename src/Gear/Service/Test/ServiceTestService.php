<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;

class ServiceTestService extends AbstractFixtureService
{
    public function mainRoute()
    {

    }

    public function allRoutesArray()
    {

    }

    public function introspectFromTable($table)
    {
        $this->tableName    = $this->str('class', $table->getTable());
        $metadata           = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));
        $this->table        = new Table($metadata->getTable($this->str('uline', $this->tableName)));


        $src = $this->getGearSchema()->getSrcByDb($table, 'Service');

        $order = [***REMOVED***;
        $selectOneBy = [***REMOVED***;

        $base = array(
            'method' => $this->tableName.'Service', 'module' => $this->getConfig()->getModule(), 'entityName' => $this->tableName
        );
        $primaryKeyColumn   = $this->table->getPrimaryKeyColumns();
        $this->usePrimaryKey = true;

        foreach ($this->getValidColumnsFromTable() as $column) {

            $baseColumn = array_merge($base, ['var' => $this->str('var', $column->getName()), 'class' => $this->str('class', $column->getName())***REMOVED***);


            if (in_array($column->getName(), $primaryKeyColumn)) {
                $labelAsc = '1';
                $labelDesc = '30';
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array( 'value' => '15'));
            }

            if (in_array($column->getDataType(), array('text', 'varchar'))) {

                if (!isset($firstValidString)) {
                    $firstValidString = $this->str('var', $column->getName());
                }
                //segundo a lei da string, 1 = 10
                // 30 = 9
                $labelAsc = '\'10'.$this->str('label', $column->getName()).'\'';
                $labelDesc = '\'9'.$this->str('label', $column->getName()).'\'';

                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array('value' => '\'15'.$this->str('label', $column->getName()).'\''));

                $valueToInsertArray[***REMOVED*** = $this->getInsertArrayByColumn($column);
                $valueToInsertAssert[***REMOVED*** = $this->getInsertAssertByColumn($column);
                $valueToUpdateArray[***REMOVED*** = $this->getUpdateArrayByColumn($column);
                $valueToUpdateAssert[***REMOVED*** = $this->getUpdateAssertByColumn($column);

            }

            $order[***REMOVED*** = array_merge($baseColumn, array('order' => 'ASC', 'value' => $labelAsc));
            $order[***REMOVED*** = array_merge($baseColumn, array('order' => 'DESC', 'value' => $labelDesc));
        }

        // pega o primeiro campo varchar para usar no route.
        // pega a primary key pra usar no route.


        $this->createFileFromTemplate(
            'template/test/unit/service/full.service.phtml',
            array(
                'serviceNameUline' => substr($this->str('var', $src->getName()), 0, 18),
                'serviceNameVar' => substr($this->str('var', $src->getName()), 0, 18),
                'serviceNameClass'   => $src->getName(),
                'class' => $this->str('class', str_replace('Service', '', $src->getName())),
                'module'  => $this->getConfig()->getModule(),
                'injection' => $this->getClassService()->getTestInjections($src),
                'order' => $order,
                'oneBy' => $selectOneBy,
                'where' => array(),
                'firstString' => $firstValidString,
                'insertArray' => $valueToInsertArray,
                'updateArray' => $valueToUpdateArray,
                'insertAssert' => $valueToInsertAssert,
                'updateAssert' => $valueToUpdateAssert
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestServiceFolder()
        );

    }
}
