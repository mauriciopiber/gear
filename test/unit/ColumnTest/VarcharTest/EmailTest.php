<?php
namespace GearTest\ColumnTest\VarcharTest;

use PHPUnit\Framework\TestCase;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Varchar\Email;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\Email
 */
class EmailTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->column = $this->prophesize(ColumnObject::class);
        $this->column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/column/varchar/email';
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

    public function testGetFilterElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();


        $this->email = new Email($this->column->reveal());
        $this->email->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->email->filterElement();

        $expected = $this->template.'/filter-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    public function testGetFilterUniqueElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();
        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();

        $this->email = new Email($this->column->reveal());
        $this->email->setStringService(new \Gear\Util\String\StringService());

        $filter = $this->email->filterUniqueElement();

        $expected = $this->template.'/filter-unique-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $this->email = new Email($this->column->reveal());
        $this->email->setStringService(new \Gear\Util\String\StringService());

        $value = $this->email->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->email = new Email($this->column->reveal());
        $this->email->setStringService(new \Gear\Util\String\StringService());
        $value = $this->email->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

