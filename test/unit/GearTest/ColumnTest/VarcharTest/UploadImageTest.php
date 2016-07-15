<?php
namespace GearTest\ColumnTest\VarcharTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Varchar\UploadImage;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\UploadImage
 */
class UploadImageTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $column->getTableName()->willReturn('my_table')->shouldBeCalled();
        $column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->uploadImage = new UploadImage($column->reveal());
        $this->uploadImage->setStringService(new \GearBase\Util\String\StringService());
    }

    public function values()
    {
        return [
            [30, '/upload/my-table-myColumn/pre30myColumn.gif'***REMOVED***,
            [01, '/upload/my-table-myColumn/pre01myColumn.gif'***REMOVED***,
            [90, '/upload/my-table-myColumn/pre90myColumn.gif'***REMOVED***,
            [2123, '/upload/my-table-myColumn/pre2123myColumn.gif'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->uploadImage->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->uploadImage->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

