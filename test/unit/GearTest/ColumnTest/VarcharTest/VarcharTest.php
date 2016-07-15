<?php
namespace GearTest\ColumnTest\VarcharTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Varchar\Varchar;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\Varchar
 */
class VarcharTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();

        $this->varchar = new Varchar($column->reveal());
    }

    public function values()
    {
        return [
            [30, '30%s'***REMOVED***,
            [01, '01%s'***REMOVED***,
            [90, '90%s'***REMOVED***,
            [2123, '2123%s'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->varchar->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->varchar->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

