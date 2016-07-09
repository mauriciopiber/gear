<?php
namespace GearTest\MvcTest\SpecTest\FeatureTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearJson\Action\Action;
use GearJson\Controller\Controller;
use GearJson\Db\Db;

/**
 * @group Spec
 */
class FeatureTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('public')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec/e2e')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec/e2e/index')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/public/js/spec/e2e/index');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getPublicJsSpecEndFolder()
          ->willReturn(vfsStream::url('module/public/js/spec/e2e'))
          ->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/spec';

        $this->dir = new \GearBase\Util\Dir\DirService();

        $this->feature = new \Gear\Mvc\Spec\Feature\Feature();
        $this->feature->setStringService($this->string);
        $this->feature->setFileCreator($this->fileCreator);
        $this->feature->setDirService($this->dir);
    }


    public function testIntrospectFromTable()
    {

        $this->feature->setDirService($this->dir);
        $this->feature->setGearVersion('0.0.99');
        $this->feature->setModule($this->module->reveal());

        $table = new \GearJson\Db\Db([
            'table' => 'myTable'
        ***REMOVED***);

        $controller = new \GearJson\Controller\Controller([
            'name' => 'MyTableController',
            'object' => '%s\Controller\MyTableController',
            'actions' => [
                [
                    'name' => 'Create'
                ***REMOVED***,
                [
                    'name' => 'Edit'
                ***REMOVED***,
                [
                    'name' => 'View'
                ***REMOVED***,
                [
                    'name' => 'Delete'
                ***REMOVED***,
                [
                    'name' => 'List'
                ***REMOVED***,
            ***REMOVED***
        ***REMOVED***);

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schema->getControllerByDb($table)->willReturn($controller)->shouldBeCalled();

        $this->feature->setSchemaService($this->schema->reveal());

        /**
        $action = new \GearJson\Action\Action([
            'name' => 'MyAction',
            'controller' => 'MyController'
        ***REMOVED***);*/

        $this->columns = $this->prophesize('Gear\Column\ColumnService');
        $this->columns->getColumns($table)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->feature->setColumnService($this->columns->reveal());


        $file = $this->feature->introspectFromTable($table);

        $this->assertTrue($file);
    }



    /**
     * @group Action
     */
    public function testCreateAction()
    {

        $this->feature->setDirService($this->dir);
        $this->feature->setGearVersion('0.0.99');
        $this->feature->setModule($this->module->reveal());
        $action = new \GearJson\Action\Action([
            'name' => 'MyAction',
            'controller' => 'MyController'
        ***REMOVED***);

        $file = $this->feature->build($action);

        $this->assertStringEndsWith('/my-controller/my-action.feature', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/action.feature.phtml'),
            file_get_contents($file)
        );
    }

    public function testCreateIndexFeature()
    {
        $this->feature->setModule($this->module->reveal());
        $file = $this->feature->createIndexFeature();

        $expected = $this->template.'/module.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    public function testCreateIndexFeatureProject()
    {
        $this->feature->setModule($this->module->reveal());
        $file = $this->feature->createIndexFeature('MyProject');

        $expected = $this->template.'/module.feature.project.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testBuildCreateAction()
    {
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => new Db(['table' => 'MyController'***REMOVED***)
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());
        $file = $this->feature->buildCreateAction($action);

        $expected = $this->template.'/create.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testBuildEditAction()
    {
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => new Db(['table' => 'MyController'***REMOVED***)
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());

        $file = $this->feature->buildEditAction($action);

        $expected = $this->template.'/edit.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    public function testBuildListAction()
    {
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => new Db(['table' => 'MyController'***REMOVED***)
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());

        $file = $this->feature->buildListAction($action);

        $expected = $this->template.'/list.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    public function prophesizeColumn($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);

        return $column->reveal();
    }

    public function prophesizeForeignKey($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference)->shouldBeCalled();
        }

        return $foreignKey->reveal();
    }

    public function getAllPossibleColumns()
    {
        $columns = [***REMOVED***;

        $columns[***REMOVED*** = new \Gear\Column\Int\PrimaryKey(
            $this->prophesizeColumn('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKey('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[***REMOVED*** = new \Gear\Column\Date\Date($this->prophesizeColumn('table', 'date_column', 'date'));
        $columns[***REMOVED*** = new \Gear\Column\Date\DatePtBr($this->prophesizeColumn('table', 'date_pt_br_column', 'date'));

        //datetime
        $columns[***REMOVED*** = new \Gear\Column\Datetime\Datetime(
            $this->prophesizeColumn('table', 'datetime_column', 'datetime')
        );
        $columns[***REMOVED*** = new \Gear\Column\Datetime\DatetimePtBr(
            $this->prophesizeColumn('table', 'datetime_pt_br_column', 'datetime')
        );

        //time
        $columns[***REMOVED*** = new \Gear\Column\Time\Time(
            $this->prophesizeColumn('table', 'time_column', 'time')
        );

        $columns[***REMOVED*** = new \Gear\Column\Decimal\Decimal(
            $this->prophesizeColumn('table', 'decimal_column', 'decimal')
        );

        $columns[***REMOVED*** = new \Gear\Column\Decimal\MoneyPtBr(
            $this->prophesizeColumn('table', 'money_pt_br_column', 'decimal')
        );

        $columns[***REMOVED*** = new \Gear\Column\Int\Checkbox(
            $this->prophesizeColumn('table', 'checkbox_column', 'int')
        );

        $foreignKey = new \Gear\Column\Int\ForeignKey(
            $this->prophesizeColumn('table', 'id_foreign_key_column', 'int'),
            $this->prophesizeForeignKey('table', 'id_foreign_key_column', 'FOREIGN KEY', 'foreign_key_column')
        );



        $schema = $this->prophesize('Zend\Db\Metadata\Metadata');
        $schema->getColumns('foreign_key_column')
        ->willReturn([$this->prophesizeColumn('foreign_key', 'foreign_key_column', 'varchar')***REMOVED***)->shouldBeCalled();

        $foreignKey->setMetadata($schema->reveal());

        $columns[***REMOVED*** = $foreignKey;

        $columns[***REMOVED*** = new \Gear\Column\Int\Int(
            $this->prophesizeColumn('table', 'int_column', 'int')
        );

        $columns[***REMOVED*** = new \Gear\Column\Text\Html(
            $this->prophesizeColumn('table', 'html_column', 'text')
        );

        $columns[***REMOVED*** = new \Gear\Column\Text\Text(
            $this->prophesizeColumn('table', 'text_column', 'text')
        );

        $columns[***REMOVED*** = new \Gear\Column\Tinyint\Tinyint(
            $this->prophesizeColumn('table', 'tinyint_column', 'tinyint')
        );

        $columns[***REMOVED*** = new \Gear\Column\Tinyint\Checkbox(
            $this->prophesizeColumn('table', 'checkbox_column', 'tinyint')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Email(
            $this->prophesizeColumn('table', 'email_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\PasswordVerify(
            $this->prophesizeColumn('table', 'password_verify_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Telephone(
            $this->prophesizeColumn('table', 'telephone_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\UniqueId(
            $this->prophesizeColumn('table', 'unique_id_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\UploadImage(
            $this->prophesizeColumn('table', 'upload_image_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Url(
            $this->prophesizeColumn('table', 'url_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Varchar(
            $this->prophesizeColumn('table', 'varchar_column', 'varchar')
        );


        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }

    public function testBuildViewAction()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);

        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());


        $columns = $this->getAllPossibleColumns();



        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($columns)->shouldBeCalled();

        $this->feature->setColumnService($this->column->reveal());

        $file = $this->feature->buildViewAction($action);

        $expected = $this->template.'/view.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testBuildDeleteAction()
    {
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => new Db(['table' => 'MyController'***REMOVED***)
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());

        $file = $this->feature->buildDeleteAction($action);

        $expected = $this->template.'/delete.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

}
