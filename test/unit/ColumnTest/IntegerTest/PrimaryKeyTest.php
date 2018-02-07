<?php
namespace GearTest\ColumnTest\IntTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Integer\PrimaryKey;

/**
 * @group AbstractColumn
 * @group Column\Int
 * @group Column\Integer\PrimaryKey
 */
class PrimaryKeyTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $this->column->getDataType()->willReturn('int')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->constraint = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $this->constraint->getType()->willReturn('PRIMARY KEY')->shouldBeCalled();
        $this->constraint->getColumns()->willReturn(['my_column'***REMOVED***)->shouldBeCalled();
    }

    public function valuesDb()
    {
        return [
            [30, '30'***REMOVED***,
            [01, '1'***REMOVED***,
            [90, '90'***REMOVED***,
            [2123, '2123'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueView($iterator, $expected)
    {
       $this->primaryKey = new PrimaryKey($this->column->reveal(), $this->constraint->reveal());

        $value = $this->primaryKey->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->primaryKey = new PrimaryKey($this->column->reveal(), $this->constraint->reveal());

        $value = $this->primaryKey->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

