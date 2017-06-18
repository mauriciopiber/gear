<?php
namespace GearTest\ColumnTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Column\ColumnManager;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Varchar\PasswordVerify;
use Gear\Column\Varchar\UploadImage;
use Gear\Column\Varchar\Varchar;
use Gear\Mvc\Service\ServiceService;
use Gear\Mvc\Service\ServiceTestService;
use Gear\Module\BasicModuleStructure;
use GearBase\Util\String\StringService;

/**
 * @group Service
 */
class ColumnManagerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->columnManager = new ColumnManager([***REMOVED***);

    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Column\ColumnManager', $this->columnManager);
    }

    /**
     * @dataProvider getServiceColumns
     * @group cm1
     */
    public function testAssociatedColumn($columns)
    {
        $columnManager = new ColumnManager($columns);

        $this->assertTrue($columnManager->isAssociatedWith(UploadImage::class));
        $this->assertTrue($columnManager->isAssociatedWith(PasswordVerify::class));
        $this->assertFalse($columnManager->isAssociatedWith(Varchar::class));

    }

    public function getServiceColumns()
    {
        $this->string = new StringService();

        $columns = [***REMOVED***;

        foreach (['password_verify_one', 'password_verify_two'***REMOVED*** as $columnName) {

            $column = $this->prophesize(ColumnObject::class);
            $column->getDataType()->willReturn('varchar')->shouldBeCalled();
            $column->getName()->willReturn($columnName);
            $column->getTableName()->willReturn('service_table');
            //$column->isNullable()->willReturn(true);

            $columns[***REMOVED*** = new PasswordVerify($column->reveal());

        }

        $module = $this->prophesize(BasicModuleStructure::class);
        $module->getModuleName()->willReturn('MyModule');

        foreach (['upload_image_one', 'upload_image_two'***REMOVED*** as $columnName) {

            $column = $this->prophesize(ColumnObject::class);
            $column->getDataType()->willReturn('varchar')->shouldBeCalled();
            $column->getName()->willReturn($columnName);
            $column->getTableName()->willReturn('service_table');

            $uploadImage = new UploadImage($column->reveal());
            $uploadImage->setModule($module->reveal());

            $columns[***REMOVED*** = $uploadImage;
        }

        foreach ($columns as $columnS) {
            $columnS->setStringService($this->string);
        }

        return [[$columns***REMOVED******REMOVED***;
    }

    const SERVICE_CREATE_0 = <<<EOS
        \$this->createPassword('passwordVerifyOne');
        \$this->createPassword('passwordVerifyTwo');
        \$images = \$this->getImageService()->replaceDataForm(
            \$data,
            'service-table',
            self::IMAGES
        );

EOS;

    const SERVICE_CREATE_1 = <<<EOS
            \$this->getImageService()->saveImageColumns(
                \$images,
                'service-table'
            );

EOS;

    const SERVICE_UPDATE_0 = <<<EOS
        \$this->createPassword('passwordVerifyOne');
        \$this->createPassword('passwordVerifyTwo');
        \$images = \$this->getImageService()->replaceDataForm(
            \$data,
            'service-table',
            self::IMAGES
        );

EOS;

    const SERVICE_UPDATE_1 = <<<EOS
            \$this->getImageService()->saveImageColumns(
                \$images,
                'service-table'
            );

EOS;

    const DELETE_1 = <<<EOS
            \$this->getImageService()->deleteImagesTableColumn(
                \$entity,
                self::IMAGES,
                'service-table'
            );

EOS;

    /**
     * @dataProvider getServiceColumns
     * @group cm1
     */
    public function testCreateServiceSchema($columns)
    {

        $columnManager = new ColumnManager($columns);


        $schema = $columnManager->generateSchema(ServiceService::COLUMN_SCHEMA);


        $this->created = [
            0 => self::SERVICE_CREATE_0,
            1 => self::SERVICE_CREATE_1
        ***REMOVED***;

        $this->update = [
            0 => self::SERVICE_UPDATE_0,
            1 => self::SERVICE_UPDATE_1
        ***REMOVED***;

        $this->delete = [
            0 => self::DELETE_1
        ***REMOVED***;


        $this->assertEquals($schema['create'***REMOVED***[0***REMOVED***, $this->created[0***REMOVED***);
        $this->assertEquals($schema['create'***REMOVED***[1***REMOVED***, $this->created[1***REMOVED***);
        $this->assertEquals($schema['update'***REMOVED***[0***REMOVED***, $this->update[0***REMOVED***);
        $this->assertEquals($schema['update'***REMOVED***[1***REMOVED***, $this->update[1***REMOVED***);
        $this->assertEquals($schema['delete'***REMOVED***[0***REMOVED***, $this->delete[0***REMOVED***);
    }

    const SERVICE_TEST_CREATE_0 = <<<EOS
        \$this->imageService->replaceDataForm(
            \$data,
            'service-table',
            ServiceTableService::IMAGES
        )->willReturn([***REMOVED***)->shouldBeCalled();

        \$this->imageService->saveImageColumns(
            [***REMOVED***,
            'service-table'
        )->shouldBeCalled();

EOS;

    const SERVICE_TEST_CREATE_1 = <<<EOS
            'uploadImageOne' => 'image123',
            'uploadImageTwo' => 'image123',

EOS;


    const SERVICE_TEST_UPDATE_0 = <<<EOS
        \$this->imageService->replaceDataForm(
            \$data,
            'service-table',
            ServiceTableService::IMAGES
        )->willReturn([***REMOVED***)->shouldBeCalled();

        \$this->imageService->saveImageColumns(
            [***REMOVED***,
            'service-table'
        )->shouldBeCalled();

EOS;


    const SERVICE_TEST_UPDATE_1 = <<<EOS
            'uploadImageOne' => 'image123',
            'uploadImageTwo' => 'image123',

EOS;


    const SERVICE_TEST_SET_UP = <<<EOS

        \$this->imageService = \$this->prophesize('GearImage\Service\ImageService');
        \$this->service->setImageService(\$this->imageService->reveal());

EOS;



    /**
     * @dataProvider getServiceColumns
     * @group cm1
     */
    public function testCreateServiceTestSchema($columns)
    {
        $columnManager = new ColumnManager($columns);


        $schema = $columnManager->generateSchema(ServiceTestService::COLUMN_SCHEMA);


        $this->created = [
            0 => self::SERVICE_TEST_CREATE_0,
            1 => self::SERVICE_TEST_CREATE_1
        ***REMOVED***;

        $this->update = [
            0 => self::SERVICE_TEST_UPDATE_0,
            1 => self::SERVICE_TEST_UPDATE_1
        ***REMOVED***;

        $this->setUp = [
            0 => self::SERVICE_TEST_SET_UP
        ***REMOVED***;

        $this->assertEquals($schema['create'***REMOVED***[0***REMOVED***, $this->created[0***REMOVED***);
        $this->assertEquals($schema['create'***REMOVED***[1***REMOVED***, $this->created[1***REMOVED***);
        $this->assertEquals($schema['update'***REMOVED***[0***REMOVED***, $this->update[0***REMOVED***);
        $this->assertEquals($schema['update'***REMOVED***[1***REMOVED***, $this->update[1***REMOVED***);
        $this->assertEquals($schema['setUp'***REMOVED***[0***REMOVED***, $this->setUp[0***REMOVED***);
    }
}
