<?php
namespace GearTest\ColumnTest\TimeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Time\Time;

/**
 * @group AbstractColumn
 */
class TimeTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('time')->shouldBeCalled();


        $this->time = new Time($column->reveal());

    }

    public function values()
    {
        return [
            [30, '06:00:30'***REMOVED***,
            [01, '01:00:01'***REMOVED***,
            [90, '18:00:30'***REMOVED***
        ***REMOVED***;
    }


    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->time->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->time->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

