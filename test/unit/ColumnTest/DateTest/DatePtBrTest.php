<?php
namespace GearTest\ColumnTest\DateTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\Date\DatePtBr;

/**
 * @group AbstractColumn
 * @group DateColumn
 */
class DatePtBrTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('date')->shouldBeCalled();


        $this->datePtBr = new DatePtBr($column->reveal());

    }

    public function valuesView()
    {
        return [
            [30, '30/06/2007'***REMOVED***,
            [01, '01/01/2001'***REMOVED***,
            [90, '01/06/2021'***REMOVED***
        ***REMOVED***;
    }

    public function valuesDb()
    {
        return [
            [30, '2007-06-30'***REMOVED***,
            [01, '2001-01-01'***REMOVED***,
            [90, '2021-06-01'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider valuesView
     * @param unknown $expected
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->datePtBr->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->datePtBr->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

