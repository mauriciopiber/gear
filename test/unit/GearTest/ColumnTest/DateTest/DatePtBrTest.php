<?php
namespace GearTest\ColumnTest\DateTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Date\DatePtBr;

/**
 * @group AbstractColumn
 */
class DatePtBrTest extends AbstractTestCase
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
            [30, '30/12/2020'***REMOVED***,
            [01, '01/12/2020'***REMOVED***,
            [90, '01/12/2020'***REMOVED***
        ***REMOVED***;
    }

    public function valuesDb()
    {
        return [
            [30, '2020-12-30'***REMOVED***,
            [01, '2020-12-01'***REMOVED***,
            [90, '2020-12-01'***REMOVED***
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
