<?php
namespace GearTest\ColumnTest\VarcharTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Varchar\Email;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\Email
 */
class EmailTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->email = new Email($column->reveal());
        $this->email->setStringService(new \GearBase\Util\String\StringService());
    }

    public function values()
    {
        return [
            [30, 'my.column30@gmail.com'***REMOVED***,
            [01, 'my.column01@gmail.com'***REMOVED***,
            [90, 'my.column90@gmail.com'***REMOVED***,
            [2123, 'my.column2123@gmail.com'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->email->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->email->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

