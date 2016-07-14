<?php
namespace GearTest\ColumnTest\DatetimeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Datetime\DatetimePtBr;

/**
 * @group AbstractColumn
 */
class DateTimePtBrTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('datetime')->shouldBeCalled();


        $this->datetimePtBr = new DatetimePtBr($column->reveal());

    }

    public function valuesView()
    {
        return [
            [30, '30/12/2020 06:00:02'***REMOVED***,
            [01, '01/12/2020 01:00:02'***REMOVED***,
            [90, '01/12/2020 18:00:02'***REMOVED***
        ***REMOVED***;
    }

    public function valuesDb()
    {
        return [
            [30, '2020-12-30 06:00:02'***REMOVED***,
            [01, '2020-12-01 01:00:02'***REMOVED***,
            [90, '2020-12-01 18:00:02'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider valuesView
     * @param unknown $expected
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->datetimePtBr->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->datetimePtBr->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

