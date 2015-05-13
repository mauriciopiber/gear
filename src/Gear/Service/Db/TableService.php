<?php
namespace Gear\Service\Db;

use Gear\Service\AbstractJsonService;
use Zend\Console\ColorInterface;

class TableService extends DbAbstractService
{
    public function createColumn($table, $column, $type, $limit = null, $null = true)
    {

        $global = require \Gear\Service\ProjectService::getProjectFolder().'/config/autoload/global.php';
        $local  = require \Gear\Service\ProjectService::getProjectFolder().'/config/autoload/local.php';

        $tableObject = new \Phinx\Db\Table(
            $table,
            array(),
            new \Phinx\Db\Adapter\MysqlAdapter(
                array_merge($global['phinx'***REMOVED***, $local['phinx'***REMOVED***)
            )
        );
        $tableObject->addColumn($column, $type, array('limit' => $limit, 'null' => $null));
        $tableObject->update();

        echo 'createcolumn'."\n";

    }

    public function dropTable($tableName)
    {
        $adapter = $this->getAdapter();
        if ($adapter->hasTable($tableName)) {
            $table = $this->table($tableName);
            $table->drop();
        }
    }

    public function mockConstraints()
    {
        $constraints = $this->metadata->getConstraints($this->str('uline', $this->tableName));


        $this->mockConstraints = <<<EOS
        \$constraints = [***REMOVED***;
        \$stubs = array(
            'getName',
            'getTableName',
            'getSchemaName',
            'getType',
            'getColumns',
            'getReferencedTableSchema',
            'getReferencedTableName',
            'getReferencedColumns',
            'getMatchOption',
            'getUpdateRule',
            'getDeleteRule',
            'getCheckClause'
        );
EOS;

        foreach ($constraints as $constraintObject) {

            $columns = '[\''.implode('\',\'', $constraintObject->getColumns()).'\'***REMOVED***';
            if (!empty($constraintObject->getReferencedColumns())) {
                $referenced =  '[\''.implode('\',\'', $constraintObject->getReferencedColumns()).'\'***REMOVED***';
            } else {
                $referenced = 'null';
            }


            $this->mockConstraints .= <<<EOS

        \$constraint = \$this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            \$stubs
        );
        \$constraint->expects(\$this->any())->method('getName')->willReturn('{$constraintObject->getName()}');
        \$constraint->expects(\$this->any())->method('getTableName')->willReturn('{$constraintObject->getTableName()}');
        \$constraint->expects(\$this->any())->method('getSchemaName')->willReturn('{$constraintObject->getSchemaName()}');
        \$constraint->expects(\$this->any())->method('getType')->willReturn('{$constraintObject->getType()}');
        \$constraint->expects(\$this->any())->method('getColumns')->willReturn({$columns});
        \$constraint->expects(\$this->any())->method('getReferencedTableSchema')->willReturn('{$constraintObject->getReferencedTableSchema()}');
        \$constraint->expects(\$this->any())->method('getReferencedTableName')->willReturn('{$constraintObject->getReferencedTableName()}');
        \$constraint->expects(\$this->any())->method('getReferencedColumns')->willReturn($referenced);
        \$constraint->expects(\$this->any())->method('getMatchOption')->willReturn('{$constraintObject->getMatchOption()}');
        \$constraint->expects(\$this->any())->method('getUpdateRule')->willReturn('{$constraintObject->getUpdateRule()}');
        \$constraint->expects(\$this->any())->method('getDeleteRule')->willReturn('{$constraintObject->getDeleteRule()}');
        \$constraint->expects(\$this->any())->method('getCheckClause')->willReturn('{$constraintObject->getCheckClause()}');

        \$constraints[***REMOVED*** = \$constraint;

EOS;
        }

        $this->mockConstraints .= <<<EOS
        return \$constraints;

EOS;

    }

    public function mockColumns()
    {
        $columns = $this->metadata->getColumns($this->str('uline', $this->tableName));


        $this->mockColumns = <<<EOS
        \$columns = [***REMOVED***;
        \$stubs = array(
            'getName',
            'getTableName',
            'getSchemaName',
            'getOrdinalPosition',
            'getColumnDefault',
            'isNullable',
            'getDataType',
            'getCharacterMaximumLength',
            'getCharacterOctetLength',
            'getNumericPrecision',
            'getNumericScale',
            'isNumericUnsigned',
            'getErratas'
        );
EOS;

        foreach ($columns as $columnObject) {

            if (!empty($columnObject->getErratas())) {
                $errata =  '[\''.implode('\',\'', $columnObject->getErratas()).'\'***REMOVED***';
            } else {
                $errata = 'null';
            }

            $columnsDefault = ($columnObject->getColumnDefault() !== null) ? '\''.$columnObject->getColumnDefault().'\'' : 'null';

            $isNullable = ($columnObject->isNullable() == true) ? 'true' : 'false';




            $this->mockColumns .= <<<EOS

        \$column = \$this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            \$stubs
        );
        \$column->expects(\$this->any())->method('getName')->willReturn('{$columnObject->getName()}');
        \$column->expects(\$this->any())->method('getTableName')->willReturn('{$columnObject->getTableName()}');
        \$column->expects(\$this->any())->method('getSchemaName')->willReturn('{$columnObject->getSchemaName()}');
        \$column->expects(\$this->any())->method('getOrdinalPosition')->willReturn('{$columnObject->getOrdinalPosition()}');
        \$column->expects(\$this->any())->method('getColumnDefault')->willReturn({$columnsDefault});
        \$column->expects(\$this->any())->method('isNullable')->willReturn({$isNullable});
        \$column->expects(\$this->any())->method('getDataType')->willReturn('{$columnObject->getDataType()}');
        \$column->expects(\$this->any())->method('getCharacterMaximumLength')->willReturn('{$columnObject->getCharacterMaximumLength()}');
        \$column->expects(\$this->any())->method('getCharacterOctetLength')->willReturn('{$columnObject->getCharacterOctetLength()}');
        \$column->expects(\$this->any())->method('getNumericPrecision')->willReturn('{$columnObject->getNumericPrecision()}');
        \$column->expects(\$this->any())->method('getNumericScale')->willReturn('{$columnObject->getNumericScale()}');
        \$column->expects(\$this->any())->method('isNumericUnsigned')->willReturn('{$columnObject->isNumericUnsigned()}');
        \$column->expects(\$this->any())->method('getErratas')->willReturn($errata);

        \$columns[***REMOVED*** = \$column;
EOS;

        }

        $this->mockColumns .= <<<EOS
        return \$columns;

EOS;

    }

    public function mockTableObject()
    {
        $table = $this->metadata->getTable($this->str('uline', $this->tableName));

        $tableClass = $this->str('class', $this->tableName);

        $this->mockTable .= <<<EOS
        \$table = \$this->getMockSingleClass(
            'Zend\Db\Metadata\Object\TableObject',
            array(
                'getColumns',
                'getConstraints',
                'getName'
            )
        );

        \$table->expects(\$this->any())->method('getColumns')->willReturn(\$this->get{$tableClass}ColumnsMock());
        \$table->expects(\$this->any())->method('getConstraints')->willReturn(\$this->get{$tableClass}ConstraintsMock());
        \$table->expects(\$this->any())->method('getName')->willReturn('{$this->tableName}');

        return \$table;

EOS;
        //var_dump(get_class_methods($table));
    }

    public function mockTable()
    {
        $this->tableName = $this->getRequest()->getParam('table');
        $moduleName = $this->getRequest()->getParam('module');

        $module = $this->getServiceLocator()->get('moduleStructure');
        $module->setModuleName($moduleName);
        $module->prepare();

        $this->metadata = $this->getMetadata();


        $this->mockConstraints = '';
        $this->mockConstraints();
        $this->mockColumns     = '';
        $this->mockColumns();
        $this->mockTable       = '';
        $this->mockTableObject();

        $this->file = $this->getServiceLocator()->get('fileCreator');

        $this->file->setTemplate('template/test/unit/mock-table.phtml');
        $this->file->setLocation($module->getTestUnitModuleFolder());
        $this->file->setFileName($this->str('class', $this->tableName).'MockTrait.php');
        $this->file->setOptions(array(
        	'module' => $this->getModule()->getModuleName(),
            'tableName' => $this->str('class', $this->tableName),
            'mockConstraints' => $this->mockConstraints,
            'mockColumns'     => $this->mockColumns,
            'mockTable'       => $this->mockTable,
        ));
       $this->file->render();

    }

}
