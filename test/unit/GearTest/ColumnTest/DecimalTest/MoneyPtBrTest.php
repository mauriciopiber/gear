<?php
namespace GearTest\ColumnTest\DecimalTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Decimal\MoneyPtBr;

/**
 * @group AbstractColumn
 */
class MoneyPtBrTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('decimal')->shouldBeCalled();


        $this->moneyPtBr = new MoneyPtBr($column->reveal());

    }

    public function valuesDb()
    {
        return [
            [30, '30.30'***REMOVED***,
            [01, '1.01'***REMOVED***,
            [90, '90.90'***REMOVED***,
            [2123, '2123.21'***REMOVED***
        ***REMOVED***;
    }

    public function valuesView()
    {
        return [
            [30, 'R$ 30,30'***REMOVED***,
            [01, 'R$ 1,01'***REMOVED***,
            [90, 'R$ 90,90'***REMOVED***,
            [2123, 'R$ 2123,21'***REMOVED***
        ***REMOVED***;
    }


    /**
     * @dataProvider valuesView
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->moneyPtBr->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->moneyPtBr->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}
