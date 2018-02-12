<?php
namespace GearTest\ColumnTest\DecimalTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\Decimal\Decimal;

/**
 * @group AbstractColumn
 */
class DecimalTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('decimal')->shouldBeCalled();


        $this->decimal = new Decimal($column->reveal());

    }

    public function values()
    {
        return [
            [30, '30.30'***REMOVED***,
            [01, '1.01'***REMOVED***,
            [90, '90.90'***REMOVED***,
            [2123, '2123.21'***REMOVED***
        ***REMOVED***;
    }


    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->decimal->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->decimal->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

