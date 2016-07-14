<?php
namespace GearTest\ColumnTest\IntTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Int\Int;

/**
 * @group AbstractColumn
 * @group Column\Int\Int
 */
class IntTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('int')->shouldBeCalled();


        $this->int = new Int($column->reveal());

    }

    public function values()
    {
        return [
            [30, '30'***REMOVED***,
            [01, '1'***REMOVED***,
            [90, '90'***REMOVED***,
            [2123, '2123'***REMOVED***
        ***REMOVED***;
    }


    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->int->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->int->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}
