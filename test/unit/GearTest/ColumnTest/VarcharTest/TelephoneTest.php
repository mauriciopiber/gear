<?php
namespace GearTest\ColumnTest\VarcharTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Varchar\Telephone;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\Telephone
 */
class TelephoneTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();

        $this->telephone = new Telephone($column->reveal());
    }

    public function values()
    {
        return [
            [30, '(51) 9999-9930'***REMOVED***,
            [01, '(51) 9999-9901'***REMOVED***,
            [90, '(51) 9999-9990'***REMOVED***,
            [2123, '(51) 9999-9921'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->telephone->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->telephone->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

