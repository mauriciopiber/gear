<?php
namespace GearTest\ColumnTest\HtmlTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\Text\Html;

/**
 * @group AbstractColumn
 * @group Column\Text
 * @group Column\Text\Html
 */
class HtmlTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('text')->shouldBeCalled();
        $column->getName()->willReturn('my_column');

        $this->html = new Html($column->reveal());
        $this->html->setStringService(new \GearBase\Util\String\StringService());
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

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->html->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->html->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

