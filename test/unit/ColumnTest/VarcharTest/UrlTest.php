<?php
namespace GearTest\ColumnTest\VarcharTest;

use PHPUnit\Framework\TestCase;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Varchar\Url;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\Url
 */
class UrlTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->column = $this->prophesize(ColumnObject::class);
        $this->column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/column/varchar/url';
    }

    public function values()
    {
        return [
            [30, 'my.column30.com.br'***REMOVED***,
            [01, 'my.column01.com.br'***REMOVED***,
            [90, 'my.column90.com.br'***REMOVED***,
            [2123, 'my.column2123.com.br'***REMOVED***
        ***REMOVED***;
    }

    public function testGetFilterElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();


        $this->url = new Url($this->column->reveal());
        $this->url->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->url->filterElement();

        $expected = $this->template.'/filter-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    public function testGetFilterUniqueElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();
        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();

        $this->url = new Url($this->column->reveal());
        $this->url->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->url->filterUniqueElement();

        $expected = $this->template.'/filter-unique-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    public function testGetFilterNotNullElement()
    {
        $this->column->isNullable()->willReturn(false)->shouldBeCalled();


        $this->url = new Url($this->column->reveal());
        $this->url->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->url->filterElement();

        $expected = $this->template.'/filter-not-null-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    public function testGetFilterUniqueNotNullElement()
    {
        $this->column->isNullable()->willReturn(false)->shouldBeCalled();
        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();

        $this->url = new Url($this->column->reveal());
        $this->url->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->url->filterUniqueElement();

        $expected = $this->template.'/filter-unique-not-null-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $this->url = new Url($this->column->reveal());
        $this->url->setStringService(new \Gear\Util\String\StringService());

        $value = $this->url->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->url = new Url($this->column->reveal());
        $this->url->setStringService(new \Gear\Util\String\StringService());

        $value = $this->url->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

