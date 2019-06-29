<?php
namespace GearTest\ColumnTest\VarcharTest;

use PHPUnit\Framework\TestCase;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Varchar\UniqueId;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\UniqueId
 */
class UniqueIdTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $column->getName()->willReturn('my_column');

        $this->uniqueId = new UniqueId($column->reveal());
        $this->uniqueId->setStringService(new \Gear\Util\String\StringService());
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
        $value = $this->uniqueId->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->uniqueId->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

