<?php
namespace GearTest\MvcTest\SpecTest\FeatureTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearJson\Action\Action;
use GearJson\Controller\Controller;
use GearJson\Db\Db;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearBase\Util\String\StringService;
use Gear\Creator\Template\TemplateService;
use GearBase\Util\File\FileService;
use Gear\Module;
use Gear\Creator\FileCreator\FileCreator;
use GearBase\Util\Dir\DirService;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Column\ColumnService;
use Gear\Table\TableService\TableService;
use GearJson\Schema\SchemaService;
use GearTest\UtilTestTrait;
use Gear\Column\ColumnManager;

/**
 * @group Spec
 */
class FeatureTest extends TestCase
{
    use AllColumnsDbTableTrait;
    use UtilTestTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

    public function setUp()
    {
        parent::setUp();

        $this->createVirtualDir('module/public/js/spec/e2e/index');

        $this->assertFileExists(vfsStream::url('module/public/js/spec/e2e/index'));

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getPublicJsSpecEndFolder()
          ->willReturn(vfsStream::url('module/public/js/spec/e2e'))
          ->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new StringService();

        $this->fileCreator = $this->createFileCreator(Feature::TEMPLATE);

        $this->template = (new Module())->getLocation().'/../test/template/module/mvc/spec';

        $this->dir = new DirService();

        $this->feature = new Feature();
        $this->feature->setStringService($this->string);
        $this->feature->setFileCreator($this->fileCreator);
        $this->feature->setDirService($this->dir);
        $this->feature->setModule($this->module->reveal());

        $this->table = $this->prophesize(TableService::class);
        $this->feature->setTableService($this->table->reveal());

        //$this->column = $this->prophesize(ColumnService::class);
        //$this->feature->setColumnService($this->column->reveal());

        $this->schema = $this->prophesize(SchemaService::class);
        $this->feature->setSchemaService($this->schema->reveal());
    }

    public function testIntrospectFromTable()
    {
        $this->feature->setGearVersion('0.0.99');
        $this->table->isNullable('myTable')->willReturn(true)->shouldBeCalled();
        $this->table->hasUniqueConstraint('myTable')->willReturn(true)->shouldBeCalled();

        $table = new Db([
            'table' => 'myTable'
        ***REMOVED***);

        $controller = new Controller([
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

        $this->schema->getControllerByDb($table)->willReturn($controller)->shouldBeCalled();

        $table->setColumnManager(new ColumnManager([***REMOVED***));
        //$this->column->getColumns($table)->willReturn([***REMOVED***)->shouldBeCalled();

        $file = $this->feature->introspectFromTable($table);

        $this->assertTrue($file);
    }



    /**
     * @group Action
     */
    public function testCreateAction()
    {
        $this->feature->setGearVersion('0.0.99');

        $controller = new Controller(['name' => 'MyController'***REMOVED***);

        $action = new Action([
            'name' => 'MyAction',
            'controller' => $controller
        ***REMOVED***);

        $file = $this->feature->build($action);

        $this->assertStringEndsWith('/my/my-action.feature', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/action.feature.phtml'),
            file_get_contents($file)
        );
    }

    public function testCreateIndexFeature()
    {
        $file = $this->feature->createIndexFeature();

        $expected = $this->template.'/module.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    public function testCreateIndexFeatureProject()
    {
        $file = $this->feature->createIndexFeature('MyProject');

        $expected = $this->template.'/module.feature.project.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function getGearSchemaAction()
    {
        $controller = new Controller(
            [
                'name' => 'MyController',
                'object' => '%s\Controller\MyController',
                'db' => 'MyController'
            ***REMOVED***
        );

        $action = new Action([
            'name' => 'MyAction',
            'controller' => $controller,
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
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumnsNotNull()));

        //$this->column->getColumns($db)->willReturn()->shouldBeCalled();

        $this->table->isNullable('MyController')->willReturn(false)->shouldBeCalled();
        $this->table->hasUniqueConstraint('MyController')->willReturn(false)->shouldBeCalled();

        $file = $this->feature->buildCreateAction($action);

        $expected = $this->template.'/create.not.null.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }


    public function mockMyAction($usertype = 'all')
    {
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(
                [
                    'name' => 'MyController',
                    'object' => '%s\Controller\MyController',
                    'db' => 'MyController',
                    'user' => $usertype
                ***REMOVED***
            ),
        ***REMOVED***);

        return $action;
    }

    /**
     * @group n1w
     */
    public function testBuildCreateUniqueNotNullAction()
    {
        $action = $this->mockMyAction();
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumnsUniqueNotNull()));

        $this->table->isNullable('MyController')->willReturn(false)->shouldBeCalled();
        $this->table->hasUniqueConstraint('MyController')->willReturn(true)->shouldBeCalled();

        $file = $this->feature->buildCreateAction($action);

        $expected = $this->template.'/create.unique.not.null.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group lets
     */
    public function testBuildCreateUniqueAction()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(
                ['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***
            ),
        ***REMOVED***);

        $action->getController()->setDb($db);
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumnsUnique()));

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
        ***REMOVED***);

        $action->getController()->setDb($db);
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumns()));

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
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController', 'db' => 'MyController'***REMOVED***),
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
        $action->getController()->getDb()->setColumnManager(new ColumnManager($columns));

        $this->table->isNullable('MyController')->willReturn($nullable)->shouldBeCalled();
        $this->table->hasUniqueConstraint('MyController')->willReturn($unique)->shouldBeCalled();

        $file = $this->feature->buildEditAction($action);

        $expected = $this->template.'/edit'.$template.'.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    /**
     * @group feature-list
     */
    public function testBuildListUserTypeStrict()
    {
        $action = $this->mockMyAction('strict');
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumns()));

        $file = $this->feature->buildListAction($action);

        $expected = $this->template.'/list.strict.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group feature-list
     */
    public function testBuildListAction()
    {
        $action = $this->mockMyAction();
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumns()));

        $file = $this->feature->buildListAction($action);

        $expected = $this->template.'/list.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    /**
     * @group mx1
     */
    public function testBuildViewAction()
    {
        $action = $this->mockMyAction();
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumns()));

        $file = $this->feature->buildViewAction($action);

        $expected = $this->template.'/view.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group feature-delete
     */
    public function testBuildDeleteStrictAction()
    {
        $action = $this->mockMyAction('strict');
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumns()));

        $file = $this->feature->buildDeleteAction($action);

        $expected = $this->template.'/delete.strict.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group feature-delete
     */
    public function testBuildDeleteAction()
    {
        $action = $this->mockMyAction();
        $action->getController()->getDb()->setColumnManager(new ColumnManager($this->getAllPossibleColumns()));

        $file = $this->feature->buildDeleteAction($action);

        $expected = $this->template.'/delete.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group Spec1
     * @group uploadImage
     */
    public function testBuildUploadImageAction()
    {
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyTableController', 'db' => 'MyTable'***REMOVED***),
        ***REMOVED***);

        $file = $this->feature->buildUploadImageAction($action);

        $expected = $this->template.'/upload-image.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

}
