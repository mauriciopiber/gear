<?php
namespace GearTest\ColumnTest\TextTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\Text\Text;

/**
 * @group AbstractColumn
 * @group Column\Text
 * @group Column\Text\Text
 */
class TextTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('text')->shouldBeCalled();
        $column->getName()->willReturn('my_column');

        $this->text = new Text($column->reveal());
        $this->text->setStringService(new \GearBase\Util\String\StringService());
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
        $value = $this->text->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->text->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

