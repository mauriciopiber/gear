<?php
namespace GearTest\ColumnTest\DateTest;

use PHPUnit\Framework\TestCase;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Date\Date;

/**
 * @group AbstractColumn
 * @group DateColumn
 */
class DateTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn('date')->shouldBeCalled();


        $this->date = new Date($column->reveal());

    }

    /**
     * @group randomdate
     */
    public function testRandomDate()
    {
        $stack = [***REMOVED***;

        $max = 100;

        for ($i = 1; $i <= $max; $i++) {
            $value = $this->date->getValue($i);

            if (in_array($value, $stack)) {
                var_dump($i);
                var_dump($stack);
                var_dump($value);die();
            }
            $this->assertTrue(!in_array($value, $stack));
            $stack[***REMOVED*** = $value;
        }
    }

    public function values()
    {
        return [
            [30, '2007-06-30'***REMOVED***,
            [01, '2001-01-01'***REMOVED***,
            [45, '2022-09-15'***REMOVED***,
            [90, '2021-06-01'***REMOVED***,
            [05, '2005-05-05'***REMOVED***,
            [01, '2001-01-01'***REMOVED***,
            [61, '2015-01-01'***REMOVED***
            //[61***REMOVED***
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

