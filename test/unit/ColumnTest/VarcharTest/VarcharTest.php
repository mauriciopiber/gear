<?php
namespace GearTest\ColumnTest\VarcharTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\Varchar\Varchar;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\Varchar
 */
class VarcharTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $this->column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column');
        $this->column->getCharacterMaximumLength()->willReturn(45);

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/column/varchar/varchar';

    }

    public function values()
    {
        return [
            [30, '30My Column'***REMOVED***,
            [01, '01My Column'***REMOVED***,
            [90, '90My Column'***REMOVED***,
            [2123, '2123My Column'***REMOVED***
        ***REMOVED***;
    }


    public function testGetFilterElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();


        $this->varchar = new Varchar($this->column->reveal());
        $this->varchar->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->varchar->filterElement();

        $expected = $this->template.'/filter-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    public function testGetFilterUniqueElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();
        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();

        $this->varchar = new Varchar($this->column->reveal());
        $this->varchar->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->varchar->filterUniqueElement();

        $expected = $this->template.'/filter-unique-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $this->varchar = new Varchar($this->column->reveal());
        $this->varchar->setStringService(new \Gear\Util\String\StringService());

        $value = $this->varchar->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->varchar = new Varchar($this->column->reveal());
        $this->varchar->setStringService(new \Gear\Util\String\StringService());

        $value = $this->varchar->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

