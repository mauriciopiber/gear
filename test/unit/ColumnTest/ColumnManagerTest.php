<?php
namespace GearTest\ColumnTest;

use PHPUnit\Framework\TestCase;
use Gear\Column\ColumnManager;
use Zend\Db\Metadata\Object\ColumnObject;
use Zend\Db\Metadata\Object\ConstraintObject;
use Gear\Column\Varchar\PasswordVerify;
use Gear\Column\Varchar\UploadImage;
use Gear\Column\Varchar\Varchar;
use Gear\Column\Integer\ForeignKey;
use Gear\Column\Integer\PrimaryKey;
use Gear\Column\Datetime\Datetime;
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

    public function getAllColumns()
    {
        $this->string = new StringService();

        $tableName = 'my_table';

        $columns = [***REMOVED***;

        //primary key
        $pkColumn = $this->prophesize(ColumnObject::class);
        $pkColumn->getDataType()->willReturn('int')->shouldBeCalled();
        $pkColumn->getName()->willReturn('id_my_table');
        $pkColumn->getTableName()->willReturn($tableName);

        $pkConstraint = $this->prophesize(ConstraintObject::class);
        $pkConstraint->getType()->willReturn('PRIMARY KEY')->shouldBeCalled();
        $pkConstraint->getColumns()->willReturn(['id_my_table'***REMOVED***)->shouldBeCalled();

        $pKey = new PrimaryKey($pkColumn->reveal(), $pkConstraint->reveal());
        $pKey->setStringService($this->string);

        //varchar
        $columns[***REMOVED*** = $pKey;

        $vchColumn = $this->prophesize(ColumnObject::class);
        $vchColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $vchColumn->getName()->willReturn('name');
        $vchColumn->getTableName()->willReturn($tableName);

        $vchElement = new Varchar($vchColumn->reveal());
        $vchElement->setStringService($this->string);


        $columns[***REMOVED*** = $vchElement;



        //created by

        $columnsExcluded = [***REMOVED***;

        $cbyColumn = $this->prophesize(ColumnObject::class);
        $cbyColumn->getDataType()->willReturn('int')->shouldBeCalled();
        $cbyColumn->getName()->willReturn('created_by');
        $cbyColumn->getTableName()->willReturn($tableName);

        $cbyConstraint = $this->prophesize(ConstraintObject::class);
        $cbyConstraint->getType()->willReturn('FOREIGN KEY')->shouldBeCalled();
        $cbyConstraint->getColumns()->willReturn(['created_by'***REMOVED***)->shouldBeCalled();
        $cbyConstraint->getReferencedTableName()->willReturn('user');
        $cbyConstraint->getReferencedColumns()->willReturn(['id_user'***REMOVED***);

        $cbyKey = new ForeignKey($cbyColumn->reveal(), $cbyConstraint->reveal(), 'email');
        $cbyKey->setStringService($this->string);

        $columnsExcluded[***REMOVED*** = $cbyKey;

        //created

        $creColumn = $this->prophesize(ColumnObject::class);
        $creColumn->getDataType()->willReturn('datetime')->shouldBeCalled();
        $creColumn->getName()->willReturn('created');
        $creColumn->getTableName()->willReturn($tableName);

        $creKey = new Datetime($creColumn->reveal());
        $creKey->setStringService($this->string);

        $columnsExcluded[***REMOVED*** = $creKey;

        //updated by
        $ubyColumn = $this->prophesize(ColumnObject::class);
        $ubyColumn->getDataType()->willReturn('int')->shouldBeCalled();
        $ubyColumn->getName()->willReturn('updated_by');
        $ubyColumn->getTableName()->willReturn($tableName);

        $ubyConstraint = $this->prophesize(ConstraintObject::class);
        $ubyConstraint->getType()->willReturn('FOREIGN KEY')->shouldBeCalled();
        $ubyConstraint->getColumns()->willReturn(['updated_by'***REMOVED***)->shouldBeCalled();
        $ubyConstraint->getReferencedTableName()->willReturn('user');
        $ubyConstraint->getReferencedColumns()->willReturn(['id_user'***REMOVED***);

        $ubyKey = new ForeignKey($ubyColumn->reveal(), $ubyConstraint->reveal(), 'email');
        $ubyKey->setStringService($this->string);

        $columnsExcluded[***REMOVED*** = $ubyKey;

        $updColumn = $this->prophesize(ColumnObject::class);

        $updColumn->getDataType()->willReturn('datetime')->shouldBeCalled();
        $updColumn->getName()->willReturn('created');
        $updColumn->getTableName()->willReturn($tableName);

        $updKey = new Datetime($updColumn->reveal());
        $updKey->setStringService($this->string);

        $columnsExcluded[***REMOVED*** = $updKey;


        return [[$columns, $columnsExcluded***REMOVED******REMOVED***;
    }

    /**
     * @dataProvider getAllColumns
     * @group aa
     */
    public function testGetColumns($columns, $columnsExcluded)
    {
        $columnManager = new ColumnManager($columns, $columnsExcluded);
        $this->assertCount(2, $columnManager->getColumns());
    }

    /**
     * @dataProvider getAllColumns
     * @group aa
     */
    public function testGetAllColumns($columns, $columnsExcluded)
    {
        $columnManager = new ColumnManager($columns, $columnsExcluded);
        $this->assertCount(6, $columnManager->getAllColumns());
    }

    /**
     * @dataProvider getAllColumns
     * @group aa
     */
    public function testGenerateCode($columns, $columnsExcluded)
    {
        $columnManager = new ColumnManager($columns, $columnsExcluded);

        $template = <<<EOS
                'idMyTable' => '30',
                'name' => '30Name',

EOS;

        $this->assertEquals($template, $columnManager->generateCode('getFixtureData', [***REMOVED***, [***REMOVED***, 30));

        //$this->assertNull($data);
    }

    /**
     * @dataProvider getAllColumns
     * @group aa
     */
    public function testGenerateCodeAll($columns, $columnsExcluded)
    {
        $columnManager = new ColumnManager($columns, $columnsExcluded);

        $template = <<<EOS
                'idMyTable' => '30',
                'name' => '30Name',
                'createdBy' => \$this->getReference('usuariogear6'),
                'created' => \DateTime::createFromFormat('Y-m-d H:i:s', '2007-06-30 06:00:30'),
                'updatedBy' => \$this->getReference('usuariogear6'),
                'created' => \DateTime::createFromFormat('Y-m-d H:i:s', '2007-06-30 06:00:30'),

EOS;

        $this->assertEquals($template, $columnManager->generateCodeAll('getFixtureData', [***REMOVED***, [***REMOVED***, 30));
    }

    /**
     * @dataProvider getAllColumns
     *
     * @group aa
     */
    public function testExtractCode($columns, $columnsExcluded)
    {
        $columnManager = new ColumnManager($columns, $columnsExcluded);

        $template = [***REMOVED***;
        $template[***REMOVED*** = "                'idMyTable' => '30',\n";
        $template[***REMOVED*** = "                'name' => '30Name',\n";

        $this->assertEquals($template, $columnManager->extractCode('getFixtureData', [***REMOVED***, [***REMOVED***, 30));

    }

    /**
     * @dataProvider getAllColumns
     * @group aa
     */
    public function testExtractAll($columns, $columnsExcluded)
    {
        $columnManager = new ColumnManager($columns, $columnsExcluded);

        $template = [***REMOVED***;
        $template[***REMOVED*** = "                'idMyTable' => '30',\n";
        $template[***REMOVED*** = "                'name' => '30Name',\n";
        $template[***REMOVED*** = "                'createdBy' => \$this->getReference('usuariogear6'),\n";
        $template[***REMOVED*** = "                'created' => \DateTime::createFromFormat('Y-m-d H:i:s', '2007-06-30 06:00:30'),\n";
        $template[***REMOVED*** = "                'updatedBy' => \$this->getReference('usuariogear6'),\n";
        $template[***REMOVED*** = "                'created' => \DateTime::createFromFormat('Y-m-d H:i:s', '2007-06-30 06:00:30'),\n";

        $this->assertEquals($template, $columnManager->extractCodeAll('getFixtureData', [***REMOVED***, [***REMOVED***, 30));
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
