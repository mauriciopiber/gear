<?php
namespace GearTest\ColumnTest\VarcharTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Varchar\Url;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\Url
 */
class UrlTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->url = new Url($column->reveal());
        $this->url->setStringService(new \GearBase\Util\String\StringService());
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

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->url->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->url->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

