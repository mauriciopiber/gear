<?php
namespace GearTest\MvcTest\FixtureTest;

use org\bovigo\vfs\vfsStream;
use GearBaseTest\AbstractTestCase;
use GearBase\Util\String\StringService;
use GearBase\Util\File\FileService;
use GearJson\Src\Src;
use GearJson\Db\Db;
use GearTest\SingleDbTableTrait;
use GearTest\DatabaseColumnsMockerTrait;
use Gear\Creator\TemplateService;
use Gear\Creator\File;
use Gear\Module;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Creator\SrcDependency;
use Gear\Creator\Code;

/**
 * @group db-docs
 */
class FixtureServiceTest extends AbstractTestCase
{
    use SingleDbTableTrait;
    use DatabaseColumnsMockerTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->string = new StringService();
        $template       = new TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new Module)->getLocation().'/../../view'));
        $fileService    = new FileService();
        $this->fileCreator    = new File($fileService, $template);

        $this->templates = (new Module)->getLocation().'/../../test/template/module/mvc/fixture/db';

        $this->column = $this->prophesize('Gear\Column\ColumnService');

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');

        $this->fixture = new FixtureService();
        $this->fixture->setFileCreator($this->fileCreator);
        $this->fixture->setStringService($this->string);
        $this->fixture->setModule($this->module->reveal());
        $this->fixture->setColumnService($this->column->reveal());
        $this->fixture->setTableService($this->table->reveal());
        $this->fixture->setSchemaService($this->schemaService->reveal());

        $this->srcDependency = new SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->fixture->setSrcDependency($this->srcDependency);

        $this->code = new Code();
        $this->code->setSrcDependency($this->srcDependency);
        $this->code->setModule($this->module->reveal());
        $this->fixture->setCode($this->code);
    }

    public function tables()
    {
        return [[$this->getSingleColumns(), 'single-db'***REMOVED******REMOVED***;
    }

    /**
     * @group fix1
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

        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->table->getPrimaryKeyColumns($tableName)->willReturn([$primaryKey***REMOVED***);
        $this->table->getForeignKeys($this->db)->willReturn([***REMOVED***);
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);

        $service = new Src(['name' => sprintf('%sFixture', $tableName), 'type' => 'Fixture'***REMOVED***);

        $this->schemaService->getSrcByDb($this->db, 'Fixture')->willReturn($service);

        $file = $this->fixture->introspectFromTable($this->db);

        $expected = $this->templates.'/fixture-with-upload-image.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateFixtureWithUploadImageTable()
    {

    }

    public function testCreateFixtureWithUploadImageTableAndColumn()
    {

    }

    /**
     * @dataProvider tables
     * @group db-fixture
     * @group RefactoringSrc
     */
    public function testCreateCreateControllerDb($columns, $template)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getFixtureFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new Db(['table' => 'SingleDbTable'***REMOVED***);

        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->table->getPrimaryKeyColumns('SingleDbTable')->willReturn(['id_single_db_table'***REMOVED***);
        $this->table->getForeignKeys($this->db)->willReturn([***REMOVED***);
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);

        $service = new Src(['name' => 'TableFixture', 'type' => 'Fixture'***REMOVED***);

        $this->schemaService->getSrcByDb($this->db, 'Fixture')->willReturn($service);

        $file = $this->fixture->introspectFromTable($this->db);

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
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->db = new Db(['table' => 'SingleDbTable'***REMOVED***);

        $dependencies = ['my_table_one'***REMOVED***;

        $foreigns = [***REMOVED***;

        foreach ($dependencies as $dependency) {
            $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
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
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->db = new Db(['table' => 'SingleDbTable'***REMOVED***);

        $dependencies = ['my_table_one', 'my_table_two'***REMOVED***;

        $foreigns = [***REMOVED***;

        foreach ($dependencies as $dependency) {
            $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
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
