<?php
namespace GearTest\ColumnTest\VarcharTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\Varchar\UploadImage;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\UploadImage
 */
class UploadImageTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $this->column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column');

        $this->uploadImage = new UploadImage($this->column->reveal());
        $this->uploadImage->setStringService(new \Gear\Util\String\StringService());

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/column/varchar/upload-image';

        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();
    }


    public function valuesDb()
    {
        return [
            [30, 'upload/my-table-myColumn/30-%s-my-table-myColumn.gif'***REMOVED***,
            [01, 'upload/my-table-myColumn/01-%s-my-table-myColumn.gif'***REMOVED***,
            [90, 'upload/my-table-myColumn/90-%s-my-table-myColumn.gif'***REMOVED***,
            [2123, 'upload/my-table-myColumn/2123-%s-my-table-myColumn.gif'***REMOVED***,
        ***REMOVED***;
    }


    public function values()
    {
        return [
            [30, '/upload/my-table-myColumn/30-pre-my-table-myColumn.gif'***REMOVED***,
            [01, '/upload/my-table-myColumn/01-pre-my-table-myColumn.gif'***REMOVED***,
            [90, '/upload/my-table-myColumn/90-pre-my-table-myColumn.gif'***REMOVED***,
            [2123, '/upload/my-table-myColumn/2123-pre-my-table-myColumn.gif'***REMOVED***,
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
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();

        $value = $this->uploadImage->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

