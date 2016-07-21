<?php
namespace GearTest\ColumnTest\DatetimeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Datetime\Datetime;

/**
 * @group AbstractColumn
 * @group DateColumn
 * @group f1
 */
class DateTimeTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('datetime')->shouldBeCalled();


        $this->datetime = new Datetime($column->reveal());

    }

    public function values()
    {
        return [
            [30, '2007-06-30 06:00:30'***REMOVED***,
            [01, '2001-01-01 01:00:01'***REMOVED***,
            [90, '2021-06-01 18:00:30'***REMOVED***
        ***REMOVED***;
    }


    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->datetime->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->datetime->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

