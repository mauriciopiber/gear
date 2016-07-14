<?php
namespace GearTest\ColumnTest\IntTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Int\ForeignKey;

/**
 * @group AbstractColumn
 * @group Column\Int\ForeignKey
 */
class ForeignKeyTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('int')->shouldBeCalled();
        $column->getName()->willReturn('my_column')->shouldBeCalled();


        $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $foreignKey->getType()->willReturn('FOREIGN KEY')->shouldBeCalled();
        $foreignKey->getColumns()->willReturn(['my_column'***REMOVED***)->shouldBeCalled();

        $this->foreignKey = new ForeignKey($column->reveal(), $foreignKey->reveal());

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

    public function testGetValueView($iterator, $expected)
    {
        $value = $this->foreignKey->getValue($iterator);
        $this->assertEquals($expected, $value);
    }
 */

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->foreignKey->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

