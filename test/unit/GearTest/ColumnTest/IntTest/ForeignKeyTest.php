<?php
namespace GearTest\ColumnTest\IntTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Integer\ForeignKey;

/**
 * @group AbstractColumn
 * @group Column\Int
 * @group Column\Integer\ForeignKey
 */
class ForeignKeyTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $this->column->getDataType()->willReturn('int')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->constraint = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $this->constraint->getType()->willReturn('FOREIGN KEY')->shouldBeCalled();
        $this->constraint->getColumns()->willReturn(['my_column'***REMOVED***)->shouldBeCalled();
    }

    public function valuesDb()
    {
        return [
            [30, '30'***REMOVED***,
            [01, '1'***REMOVED***,
            [90, '1'***REMOVED***,
            [2123, '23'***REMOVED***
        ***REMOVED***;
    }

    public function valuesView()
    {
        return [
            [30, '30My Dep'***REMOVED***,
            [01, '1My Dep'***REMOVED***,
            [90, '1My Dep'***REMOVED***,
            [2123, '23My Dep'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider valuesView
     */
    public function testGetValueView($iterator, $expected)
    {
        $this->constraint->getReferencedTableName()->willReturn('my_table')->shouldBeCalled();

        $this->foreignKey = new ForeignKey($this->column->reveal(), $this->constraint->reveal());
        $this->foreignKey->setStringService(new \GearBase\Util\String\StringService());


        $tableService = $this->prophesize('Gear\Table\TableService\TableService');
        $tableService->getReferencedTableValidColumnName('my_table')->willReturn('my_dep')->shouldBeCalled();
        $this->foreignKey->setTableService($tableService->reveal());

        $value = $this->foreignKey->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->foreignKey = new ForeignKey($this->column->reveal(), $this->constraint->reveal());
        $this->foreignKey->setStringService(new \GearBase\Util\String\StringService());

        $value = $this->foreignKey->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }

    public function testIntegrationValidationValuesNull()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();

        $this->foreignKey = new ForeignKey($this->column->reveal(), $this->constraint->reveal());
        $this->foreignKey->setStringService(new \GearBase\Util\String\StringService());


        $text = $this->foreignKey->getIntegrationActionIsNullable();

        $expected = 'E eu vejo escolhido "Escolher:" na caixa para selecionar "My Column"';

        $this->assertEquals($expected, trim($text));
    }
}

