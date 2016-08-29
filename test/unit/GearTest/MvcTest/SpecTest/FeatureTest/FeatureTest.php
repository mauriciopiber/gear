<?php
namespace GearTest\MvcTest\SpecTest\FeatureTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearJson\Action\Action;
use GearJson\Controller\Controller;
use GearJson\Db\Db;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

/**
 * @group Spec
 */
class FeatureTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

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

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->isNullable('myTable')->willReturn(true)->shouldBeCalled();
        $this->table->hasUniqueConstraint('myTable')->willReturn(true)->shouldBeCalled();
        $this->feature->setTableService($this->table->reveal());

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

    public function getGearSchemaAction()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        return [
            [$action***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider getGearSchemaAction
     */
    public function testBuildCreateNotNullAction($action)
    {
        $db = $action->getDb();

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($this->getAllPossibleColumnsNotNull())->shouldBeCalled();
        $this->feature->setColumnService($this->column->reveal());
        $this->feature->setModule($this->module->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->isNullable('MyController')->willReturn(false)->shouldBeCalled();
        $this->table->hasUniqueConstraint('MyController')->willReturn(false)->shouldBeCalled();

        $this->feature->setTableService($this->table->reveal());

        $file = $this->feature->buildCreateAction($action);

        $expected = $this->template.'/create.not.null.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group n1w
     */
    public function testBuildCreateUniqueNotNullAction()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($this->getAllPossibleColumnsUniqueNotNull())->shouldBeCalled();

        $this->feature->setColumnService($this->column->reveal());

        $this->feature->setModule($this->module->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->isNullable('MyController')->willReturn(false)->shouldBeCalled();
        $this->table->hasUniqueConstraint('MyController')->willReturn(true)->shouldBeCalled();

        $this->feature->setTableService($this->table->reveal());

        $file = $this->feature->buildCreateAction($action);

        $expected = $this->template.'/create.unique.not.null.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testBuildCreateUniqueAction()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($this->getAllPossibleColumnsUnique())->shouldBeCalled();

        $this->feature->setColumnService($this->column->reveal());

        $this->feature->setModule($this->module->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->isNullable('MyController')->willReturn(true)->shouldBeCalled();
        $this->table->hasUniqueConstraint('MyController')->willReturn(true)->shouldBeCalled();
        $this->feature->setTableService($this->table->reveal());

        $file = $this->feature->buildCreateAction($action);

        $expected = $this->template.'/create.unique.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testBuildCreateAction()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($this->getAllPossibleColumns())->shouldBeCalled();

        $this->feature->setColumnService($this->column->reveal());

        $this->feature->setModule($this->module->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->isNullable('MyController')->willReturn(true)->shouldBeCalled();
        $this->table->hasUniqueConstraint('MyController')->willReturn(false)->shouldBeCalled();
        $this->feature->setTableService($this->table->reveal());

        $file = $this->feature->buildCreateAction($action);

        $expected = $this->template.'/create.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function tables()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);

        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        return [
            [$action, $this->getAllPossibleColumns(), '', true, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsNotNull(), '.not.null', false, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsUnique(), '.unique', true, true***REMOVED***,
            [$action, $this->getAllPossibleColumnsUniqueNotNull(), '.unique.not.null', false, true***REMOVED***,
        ***REMOVED***;
    }


    /**
     * @dataProvider tables
     * @group t1
     */
    public function testBuildEditAction($action, $columns, $template, $nullable, $unique)
    {
        $this->db = $action->getDb();

        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $this->db
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->feature->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->isNullable('MyController')->willReturn($nullable)->shouldBeCalled();
        $this->table->hasUniqueConstraint('MyController')->willReturn($unique)->shouldBeCalled();
        $this->feature->setTableService($this->table->reveal());

        $file = $this->feature->buildEditAction($action);

        $expected = $this->template.'/edit'.$template.'.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    public function testBuildListAction()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($this->getAllPossibleColumns())->shouldBeCalled();


        $this->feature->setColumnService($this->column->reveal());

        $file = $this->feature->buildListAction($action);

        $expected = $this->template.'/list.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

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

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($this->getAllPossibleColumns())->shouldBeCalled();

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

    /**
     * @group Spec1
     */
    public function testBuildUploadImageAction()
    {
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyTableController'***REMOVED***),
            'db' => new Db(['table' => 'MyTable'***REMOVED***)
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());

        $file = $this->feature->buildUploadImageAction($action);

        $expected = $this->template.'/upload-image.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

}
