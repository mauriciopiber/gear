<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;

class RepositoryTestService extends AbstractFixtureService
{
    protected $tableName;
    protected $tableColumns;
    protected $table;




    public function introspectFromTable($table)
    {
        $this->tableName    = $this->str('class', $table->getName());
        $metadata           = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));
        $this->table        = new Table($metadata->getTable($this->str('uline', $this->tableName)));

        $primaryKeyColumn   = $this->table->getPrimaryKeyColumns();

        $order = [***REMOVED***;
        $selectOneBy = [***REMOVED***;

        $base = array(
        	'method' => $this->tableName, 'module' => $this->getConfig()->getModule()
        );

        $this->usePrimaryKey = true;
        //get order
        foreach ($this->getValidColumnsFromTable() as $column) {

            $baseColumn = array_merge($base, ['var' => $this->str('var', $column->getName()), 'class' => $this->str('class', $column->getName())***REMOVED***);


            if (in_array($column->getName(), $primaryKeyColumn)) {
                $labelAsc = '1';
                $labelDesc = '30';
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array( 'value' => '15'));
            }

            if (in_array($column->getDataType(), array('text', 'varchar'))) {

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


        $this->createFileFromTemplate(
            'template/test/unit/repository/src.repository.phtml',
            array(
                'serviceNameUline' => $this->str('var', $this->tableName),
                'serviceNameClass'   => $this->tableName,
                'module'  => $this->getConfig()->getModule(),
                'order' => $order,
                'oneBy' => $selectOneBy,
                'where' => array(),
                'insertArray' => $valueToInsertArray,
                'updateArray' => $valueToUpdateArray,
                'insertAssert' => $valueToInsertAssert,
                'updateAssert' => $valueToUpdateAssert
            ),
            $this->tableName.'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

}
