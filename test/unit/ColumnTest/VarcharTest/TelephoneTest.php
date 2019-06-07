<?php
namespace GearTest\ColumnTest\VarcharTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\Varchar\Telephone;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\Telephone
 */
class TelephoneTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $this->column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column');



        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/column/varchar/telephone';
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

    public function testGetFilterElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();

        $this->telephone = new Telephone($this->column->reveal());
        $this->telephone->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->telephone->filterElement();

        $expected = $this->template.'/filter-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    public function testGetFilterUniqueElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();
        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();

        $this->telephone = new Telephone($this->column->reveal());
        $this->telephone->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->telephone->filterUniqueElement();

        $expected = $this->template.'/filter-unique-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }



    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $this->telephone = new Telephone($this->column->reveal());

        $value = $this->telephone->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->telephone = new Telephone($this->column->reveal());

        $value = $this->telephone->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

