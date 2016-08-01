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

        $this->column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $this->column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column');

        $this->uploadImage = new UploadImage($this->column->reveal());
        $this->uploadImage->setStringService(new \GearBase\Util\String\StringService());

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/column/varchar/upload-image';

        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();
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

    public function testServiceCreateMock()
    {
        $filter = $this->uploadImage->getServiceCreateMock();

        $expected = $this->template.'/service-create-mock.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    public function testServiceUpdateMock()
    {
        $filter = $this->uploadImage->getServiceUpdateMock();

        $expected = $this->template.'/service-update-mock.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueView($iterator, $expected)
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();

        $value = $this->uploadImage->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider values
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();

        $value = $this->uploadImage->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

