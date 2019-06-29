<?php
namespace GearTest\MvcTest\FixtureTest;

use org\bovigo\vfs\vfsStream;
use Gear\Table\UploadImage;
use Gear\Table\TableService\TableService;
use Gear\Schema\Schema\SchemaService;
use Gear\Mvc\Config\ConfigService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Column\DateTime\DateTime;
use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Util\File\FileService;
use Gear\Schema\Src\Src;
use Gear\Schema\Db\Db;
use GearTest\SingleDbTableTrait;
use GearTest\DatabaseColumnsMockerTrait;
use Gear\Creator\Template\TemplateService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Code\Code;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;
use Gear\Column\Integer\ForeignKey;
use Gear\Column\Integer\PrimaryKey;
use Zend\Db\Metadata\Object\ColumnObject;
use Zend\Db\Metadata\Object\ConstraintObject;
use GearTest\UtilTestTrait;

/**
 * @group db-docs
 */
class FixtureServiceTest extends TestCase
{
    use UtilTestTrait;
    use SingleDbTableTrait;
    use DatabaseColumnsMockerTrait;

    public function setUp() : void
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->string = new StringService();

        $this->fileCreator    = $this->createFileCreator();

        $this->templates = (new Module)->getLocation().'/../test/template/module/mvc/fixture/db';

        $this->table = $this->prophesize(TableService::class);

        $this->schemaService = $this->prophesize(SchemaService::class);

        $this->configService = $this->prophesize(ConfigService::class);

        $this->fixture = new FixtureService(
            $this->module->reveal(),
            $this->createFileCreator(),
            $this->string,
            $this->createCode(),
            $this->createDirService(),
            //$this->factoryService->reveal(),
            $this->table->reveal(),
            $this->createArrayService(),
            $this->createInjector()
        );
        $this->fixture->setSchemaService($this->schemaService->reveal());
        $this->fixture->setConfigService($this->configService->reveal());

        $uploadImage = new UploadImage(
            $this->string,
            $this->module->reveal()
        );

        $this->fixture->setUploadImage($uploadImage);
    }

    public function tables()
    {
        return [[$this->getSingleColumns(), 'single-db'***REMOVED******REMOVED***;
    }

    /**
     * @group a1
     */
    public function testCreateFixtureWithUploadImageColumn()
    {
        $tableName = 'MyTable';
        $moduleName = 'MyModule';
        $basePath = 'module';

        $columnsData = [
            [
                'name' => 'column_varchar',
                'type' => 'varchar',
                'class' => 'Varchar\Varchar',
                'nullable' => true
            ***REMOVED***,
            [
                'name' => 'column_upload_image',
                'type' => 'varchar',
                'class' => 'Varchar\UploadImage',
                'nullable' => true
            ***REMOVED***
        ***REMOVED***;

        $columns = $this->getColumns($moduleName, $tableName, $columnsData);

        $tableUrl = $this->string->str('url', $tableName);
        $primaryKey = sprintf('id_%s', $tableUrl);

        $this->module->getModuleName()->willReturn($moduleName)->shouldBeCalled();
        $this->module->getFixtureFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new Db(['table' => $tableName***REMOVED***);

        $this->db->setColumnManager(new ColumnManager($columns));
        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->table->getPrimaryKeyColumns($tableName)->willReturn([$primaryKey***REMOVED***);
        $this->table->getForeignKeys($this->db)->willReturn([***REMOVED***);
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);

        $service = new Src(['name' => sprintf('%sFixture', $tableName), 'type' => 'Fixture'***REMOVED***);
        $service->setDb($this->db);

        $this->schemaService->getSrcByDb($this->db, 'Fixture')->willReturn($service);

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->fixture->createFixture($this->db);

        $expected = $this->templates.'/fixture-with-column-upload-image.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group f.x1
     */
    public function testFixtureWithForeignKey()
    {
        $this->table = 'my_table';
        $this->primaryKey = 'id_my_table';

        $columnPrimaryKey = $this->prophesize(ColumnObject::class);
        $columnPrimaryKey->getDataType()->willReturn('int')->shouldBeCalled();
        $columnPrimaryKey->getName()->willReturn($this->primaryKey)->shouldBeCalled();
        $columnPrimaryKey->getTableName()->willReturn($this->table);

        $primaryConstraint = $this->prophesize(ConstraintObject::class);
        $primaryConstraint->getType()->willReturn('PRIMARY KEY')->shouldBeCalled();
        $primaryConstraint->getColumns()->willReturn([$this->primaryKey***REMOVED***)->shouldBeCalled();
        $primaryKey = new PrimaryKey($columnPrimaryKey->reveal(), $primaryConstraint->reveal());
        $primaryKey->setStringService($this->string);

        /*
        $columnCreated = $this->prophesize(ColumnObject::class);
        $created = new Datetime($columnCreated->reveal());

        $columnUpdated = $this->prophesize(ColumnObject::class);
        $updated = new Datetime($columnCreated->reveal());


        $columnCreatedBy = $this->prophesize(ColumnObject::class);
        $createdBy = new ForeignKey($columnCreatedBy->reveal());

        $columnUpdatedBy = $this->prophesize(ColumnObject::class);
        $updatedBy = new ForeignKey($columnUpdatedBy->reveal());
        */

        $columnForeignKey = $this->prophesize(ColumnObject::class);
        $columnForeignKey->getDataType()->willReturn('int')->shouldBeCalled();
        $columnForeignKey->getName()->willReturn('id_my_another_table')->shouldBeCalled();
        $columnForeignKey->getTableName()->willReturn($this->table);//->shouldBeCalled();

        $foreignConstraint = $this->prophesize(ConstraintObject::class);
        $foreignConstraint->getType()->willReturn('FOREIGN KEY')->shouldBeCalled();
        $foreignConstraint->getColumns()->willReturn(['id_my_another_table'***REMOVED***)->shouldBeCalled();
        $foreignConstraint->getReferencedTableName()->willReturn('my_another_table')->shouldBeCalled();
        $foreignConstraint->getReferencedColumns()->willReturn(['id_my_another_table'***REMOVED***)->shouldBeCalled();
        $foreignKey = new ForeignKey($columnForeignKey->reveal(), $foreignConstraint->reveal(), 'my_another_table_varchar');
        $foreignKey->setStringService($this->string);

        /*
        $primaryKey = $this->prophesize(PrimaryKey::class);
        $created = $this->prophesize(DateTime::class);
        $updated = $this->prophesize(DateTime::class);
        $createdBy = $this->prophesize(ForeignKey::class);
        $updatedBy = $this->prophesize(ForeignKey::class);
        $foreignKey = $this->prophesize(ForeignKey::class);

        */
        //$foreignKey->getTableName()->willReturn('MyAnotherTable');

        //$columns = [$primaryKey, $foreignKey, $created, $updated, $createdBy, $updatedBy***REMOVED***;
        $columns = [$primaryKey, $foreignKey***REMOVED***;

        $this->db = new Db(['table' => 'MyTable'***REMOVED***);

        $this->db->setColumnManager(new ColumnManager($columns));

        $this->src = new Src(['name' => 'MyTableFixture', 'type' => 'Fixture'***REMOVED***);
        $this->src->setDb($this->db);
        $this->schemaService->getSrcByDb($this->db, 'Fixture')->willReturn($this->src)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getFixtureFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $file = $this->fixture->createFixture($this->db);

        $expected = $this->templates.'/fixture-with-foreign-key.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
        //primary key

        //created
        //updated
        //created_by
        //updated_by

    }

    /**
     * @group a2
     */
    public function testCreateFixtureWithUploadImageTableAndColumn()
    {
        $tableName = 'MyTable';
        $moduleName = 'MyModule';
        $basePath = 'module';

        $columnsData = [
            [
                'name' => 'column_varchar',
                'type' => 'varchar',
                'class' => 'Varchar\Varchar',
                'nullable' => true
            ***REMOVED***,
            [
                'name' => 'column_upload_image',
                'type' => 'varchar',
                'class' => 'Varchar\UploadImage',
                'nullable' => true
            ***REMOVED***
        ***REMOVED***;

        $columns = $this->getColumns($moduleName, $tableName, $columnsData);

        $tableUrl = $this->string->str('url', $tableName);
        $primaryKey = sprintf('id_%s', $tableUrl);

        $this->module->getNamespace()->willReturn($moduleName)->shouldBeCalled();
        $this->module->getModuleName()->willReturn($moduleName)->shouldBeCalled();
        $this->module->getFixtureFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new Db(['table' => $tableName***REMOVED***);

        $this->db->setColumnManager(new ColumnManager($columns));
        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->table->getPrimaryKeyColumns($tableName)->willReturn([$primaryKey***REMOVED***);
        $this->table->getForeignKeys($this->db)->willReturn([***REMOVED***);
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(true);

        $service = new Src(['name' => sprintf('%sFixture', $tableName), 'type' => 'Fixture'***REMOVED***);
        $service->setDb($this->db);
        $this->schemaService->getSrcByDb($this->db, 'Fixture')->willReturn($service);

        $file = $this->fixture->createFixture($this->db);

        $expected = $this->templates.'/fixture-with-full-upload-image.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group fix1
     */
    public function testCreateFixtureWithUploadImageTable()
    {
        $tableName = 'MyTable';
        $moduleName = 'MyModule';
        $basePath = 'module';

        $columnsData = [
            [
                'name' => 'column_varchar',
                'type' => 'varchar',
                'class' => 'Varchar\Varchar',
                'nullable' => true
            ***REMOVED***
        ***REMOVED***;

        $columns = $this->getColumns($moduleName, $tableName, $columnsData);

        $tableUrl = $this->string->str('url', $tableName);
        $primaryKey = sprintf('id_%s', $tableUrl);

        $this->module->getNamespace()->willReturn($moduleName)->shouldBeCalled();
        $this->module->getModuleName()->willReturn($moduleName)->shouldBeCalled();
        $this->module->getFixtureFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new Db(['table' => $tableName***REMOVED***);
        $this->db->setColumnManager(new ColumnManager($columns));

        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->table->getPrimaryKeyColumns($tableName)->willReturn([$primaryKey***REMOVED***);
        $this->table->getForeignKeys($this->db)->willReturn([***REMOVED***);
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(true);

        $service = new Src(['name' => sprintf('%sFixture', $tableName), 'type' => 'Fixture'***REMOVED***);

        $this->schemaService->getSrcByDb($this->db, 'Fixture')->willReturn($service);

        $file = $this->fixture->createFixture($this->db);

        $expected = $this->templates.'/fixture-with-table-upload-image.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider tables
     * @group db-fixture
     * @group RefactoringSrc
     */
    public function testCreateCreateControllerDb($columns, $template)
    {
        //$this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getFixtureFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new Db(['table' => 'SingleDbTable'***REMOVED***);
        $this->db->setColumnManager(new ColumnManager($columns));

        $this->table->getPrimaryKeyColumns('SingleDbTable')->willReturn(['id_single_db_table'***REMOVED***);
        $this->table->getForeignKeys($this->db)->willReturn([***REMOVED***);
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);

        $service = new Src(['name' => 'TableFixture', 'type' => 'Fixture'***REMOVED***);

        $this->schemaService->getSrcByDb($this->db, 'Fixture')->willReturn($service);

        $file = $this->fixture->createFixture($this->db);

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testFixtureNoDependency()
    {
        $this->db = new Db(['table' => 'SingleDbTable'***REMOVED***);

        $this->table->getForeignKeys($this->db)->willReturn([***REMOVED***)->shouldBeCalled();

        $result = $this->fixture->fixtureDependency($this->db);

        $expected = <<<EOS

    /**
     * Get The Table's Foreign Keys Dependencies.
     *
     * @return string[***REMOVED***
     */
    public function getDependencies()
    {
        return ['GearAdmin\Fixture\LoadUser'***REMOVED***;
    }

EOS;

        $this->assertEquals($expected, $result);
    }

    public function testFixtureSingleDependency()
    {
        //$this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->db = new Db(['table' => 'SingleDbTable'***REMOVED***);

        $dependencies = ['my_table_one'***REMOVED***;

        $foreigns = [***REMOVED***;

        foreach ($dependencies as $dependency) {
            $foreignKey = $this->prophesize(ConstraintObject::class);
            $foreignKey->getReferencedTableName()->willReturn($dependency)->shouldBeCalled();
            $foreigns[***REMOVED*** = $foreignKey->reveal();
        }

        $this->table->getForeignKeys($this->db)->willReturn($foreigns)->shouldBeCalled();

        $result = $this->fixture->fixtureDependency($this->db);

        $expected = <<<EOS

    /**
     * Get The Table's Foreign Keys Dependencies.
     *
     * @return string[***REMOVED***
     */
    public function getDependencies()
    {
        return [
            'GearAdmin\Fixture\LoadUser',
            'MyModule\Fixture\MyTableOneFixture'
        ***REMOVED***;
    }

EOS;


        $this->assertEquals($expected, $result);
    }

    public function testFixtureDependency()
    {
        //$this->module->getNamespace()->willReturn($moduleName)->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->db = new Db(['table' => 'SingleDbTable'***REMOVED***);

        $dependencies = ['my_table_one', 'my_table_two'***REMOVED***;

        $foreigns = [***REMOVED***;

        foreach ($dependencies as $dependency) {
            $foreignKey = $this->prophesize(ConstraintObject::class);
            $foreignKey->getReferencedTableName()->willReturn($dependency)->shouldBeCalled();
            $foreigns[***REMOVED*** = $foreignKey->reveal();
        }

        $this->table->getForeignKeys($this->db)->willReturn($foreigns)->shouldBeCalled();

        $result = $this->fixture->fixtureDependency($this->db);

        $expected = <<<EOS

    /**
     * Get The Table's Foreign Keys Dependencies.
     *
     * @return string[***REMOVED***
     */
    public function getDependencies()
    {
        return [
            'GearAdmin\Fixture\LoadUser',
            'MyModule\Fixture\MyTableOneFixture',
            'MyModule\Fixture\MyTableTwoFixture'
        ***REMOVED***;
    }

EOS;

        $this->assertEquals($expected, $result);
    }
}
