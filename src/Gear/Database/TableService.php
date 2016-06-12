<?php
namespace Gear\Database;

use Gear\Creator\FileCreatorTrait;

class TableService extends DbAbstractService
{
    use FileCreatorTrait;

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

            $method = "\$constraint->expects(\$this->any())->method";

            $this->mockConstraints .= <<<EOS

        \$constraint = \$this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            \$stubs
        );
        {$method}('getName')->willReturn('{$constraintObject->getName()}');
        {$method}('getTableName')->willReturn('{$constraintObject->getTableName()}');
        {$method}('getSchemaName')->willReturn('{$constraintObject->getSchemaName()}');
        {$method}('getType')->willReturn('{$constraintObject->getType()}');
        {$method}('getColumns')->willReturn({$columns});
        {$method}('getReferencedTableSchema')->willReturn('{$constraintObject->getReferencedTableSchema()}');
        {$method}('getReferencedTableName')->willReturn('{$constraintObject->getReferencedTableName()}');
        {$method}('getReferencedColumns')->willReturn($referenced);
        {$method}('getMatchOption')->willReturn('{$constraintObject->getMatchOption()}');
        {$method}('getUpdateRule')->willReturn('{$constraintObject->getUpdateRule()}');
        {$method}('getDeleteRule')->willReturn('{$constraintObject->getDeleteRule()}');
        {$method}('getCheckClause')->willReturn('{$constraintObject->getCheckClause()}');

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

            $columnsDefault = ($columnObject->getColumnDefault() !== null)
                ? '\''.$columnObject->getColumnDefault().'\''
                : 'null';

            $isNullable = ($columnObject->isNullable() == true) ? 'true' : 'false';


            $method = "\$column->expects(\$this->any())->method";


            $this->mockColumns .= <<<EOS

        \$column = \$this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            \$stubs
        );
        {$method}('getName')->willReturn('{$columnObject->getName()}');
        {$method}('getTableName')->willReturn('{$columnObject->getTableName()}');
        {$method}('getSchemaName')->willReturn('{$columnObject->getSchemaName()}');
        {$method}('getOrdinalPosition')->willReturn('{$columnObject->getOrdinalPosition()}');
        {$method}('getColumnDefault')->willReturn({$columnsDefault});
        {$method}('isNullable')->willReturn({$isNullable});
        {$method}('getDataType')->willReturn('{$columnObject->getDataType()}');
        {$method}('getCharacterMaximumLength')->willReturn('{$columnObject->getCharacterMaximumLength()}');
        {$method}('getCharacterOctetLength')->willReturn('{$columnObject->getCharacterOctetLength()}');
        {$method}('getNumericPrecision')->willReturn('{$columnObject->getNumericPrecision()}');
        {$method}('getNumericScale')->willReturn('{$columnObject->getNumericScale()}');
        {$method}('isNumericUnsigned')->willReturn('{$columnObject->isNumericUnsigned()}');
        {$method}('getErratas')->willReturn($errata);

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

        $method = "\$table->expects(\$this->any())->method";

        $this->mockTable .= <<<EOS
        \$table = \$this->getMockSingleClass(
            'Zend\Db\Metadata\Object\TableObject',
            array(
                'getColumns',
                'getConstraints',
                'getName'
            )
        );

        {$method}('getColumns')->willReturn(\$this->get{$tableClass}ColumnsMock());
        {$method}('getConstraints')->willReturn(\$this->get{$tableClass}ConstraintsMock());
        {$method}('getName')->willReturn('{$this->tableName}');

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

        $this->file = $this->getFileCreator();

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
