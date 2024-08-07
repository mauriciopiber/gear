<?php
namespace GearTest\ColumnTest\TinyintTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\Tinyint\Tinyint;

/**
 * @group AbstractColumn
 * @group Column\Tinyint
 */
class TinyintTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('tinyint')->shouldBeCalled();


        $this->checkbox = new Tinyint($column->reveal());

    }

    public function valuesDb()
    {
        return [
            [30, '0'***REMOVED***,
            [01, '1'***REMOVED***,
            [90, '0'***REMOVED***,
            [2123, '1'***REMOVED***
        ***REMOVED***;
    }

    public function valuesView()
    {
        return [
            [30, 'Não'***REMOVED***,
            [01, 'Sim'***REMOVED***,
            [90, 'Não'***REMOVED***,
            [2123, 'Sim'***REMOVED***
        ***REMOVED***;
    }


    /**
     * @dataProvider valuesView
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->checkbox->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->checkbox->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

