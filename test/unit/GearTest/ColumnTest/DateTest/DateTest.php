<?php
namespace GearTest\ColumnTest\DateTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Date\Date;

/**
 * @group AbstractColumn
 */
class DateTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('date')->shouldBeCalled();


        $this->date = new Date($column->reveal());

    }

    public function values()
    {
        return [
            [30, '2020-12-30'***REMOVED***,
            [01, '2020-12-01'***REMOVED***,
            [90, '2020-12-01'***REMOVED***
        ***REMOVED***;
    }


    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->date->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->date->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

