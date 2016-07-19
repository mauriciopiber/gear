<?php
namespace GearTest\ColumnTest\DatetimeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Datetime\DatetimePtBr;

/**
 * @group AbstractColumn
 * @group DateColumn
 * @group f1
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
            [30, '30/06/2010 06:00:30'***REMOVED***,
            [01, '01/01/2001 01:00:01'***REMOVED***,
            [90, '01/06/2010 18:00:30'***REMOVED***
        ***REMOVED***;
    }

    public function valuesDb()
    {
        return [
            [30, '2010-06-30 06:00:30'***REMOVED***,
            [01, '2001-01-01 01:00:01'***REMOVED***,
            [90, '2010-06-01 18:00:30'***REMOVED***
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

