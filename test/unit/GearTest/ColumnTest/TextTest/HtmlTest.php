<?php
namespace GearTest\ColumnTest\HtmlTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Text\Html;

/**
 * @group AbstractColumn
 * @group Column\Text\Html
 */
class HtmlTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('text')->shouldBeCalled();

        $this->html = new Html($column->reveal());
    }

    public function values()
    {
        return [
            [30, '30%s'***REMOVED***,
            [01, '01%s'***REMOVED***,
            [90, '90%s'***REMOVED***,
            [2123, '2123%s'***REMOVED***
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

