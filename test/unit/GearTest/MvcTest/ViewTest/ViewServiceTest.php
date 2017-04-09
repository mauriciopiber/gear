<?php
namespace GearTest\MvcTest\ViewTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\Db\Db;
use GearBase\Util\String\StringService;
use GearBase\Util\File\FileService;
use GearBase\Util\Dir\DirService;
use Gear\Module;
use Gear\Creator\TemplateService;
use Gear\Creator\File;
use Gear\Mvc\View\ViewService;
use Gear\Column\Integer\PrimaryKey;
use Gear\Column\Varchar\Varchar;

/**
 * @group View
 */
class ViewServiceTest extends AbstractTestCase
{

    public function setUpBasicColumn($fuck = null, $userType = 'all')
    {
        $this->string = new StringService();

        $primaryKeyConst = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $primaryKeyConst->getType()->willReturn('PRIMARY KEY')->shouldBeCalled();
        $primaryKeyConst->getColumns()->willReturn(['id_my'***REMOVED***)->shouldBeCalled();

        $primaryKey = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $primaryKey->getDataType()->willReturn('int')->shouldBeCalled();
        $primaryKey->getName()->willReturn('id_my')->shouldBeCalled();
        $primaryKey->getTableName()->willReturn('my')->shouldBeCalled();

        $primaryKey = new PrimaryKey($primaryKey->reveal(), $primaryKeyConst->reveal());
        $primaryKey->setStringService($this->string);

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $column->getName()->willReturn('dep_name')->shouldBeCalled();
        $column->getTableName()->willReturn('my')->shouldBeCalled();

        $foreignKey = new Varchar($column->reveal());
        $foreignKey->setStringService($this->string);

        $db = new Db(['table' => 'My', 'user' => $userType***REMOVED***);

        $this->columns = $this->prophesize('Gear\Column\ColumnService');
        $this->columns->getColumns($db)->willReturn([$primaryKey, $foreignKey***REMOVED***)->shouldBeCalled();

        return [
            [
                $this->columns->reveal()
            ***REMOVED***
        ***REMOVED***;
    }

    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->template = (new Module())->getLocation().'/../../test/template/module/mvc/view';

        $this->string = new StringService();

        $template = new TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new Module)->getLocation().'/../../view'));

        $fileService        = new FileService();
        $this->fileCreator  = new File($fileService, $template);

        $this->dir = new DirService();

        $this->view = new ViewService();
        $this->view->setDirService($this->dir);
        $this->view->setStringService($this->string);
        $this->view->setFileCreator($this->fileCreator);
        $this->view->setModule($this->module->reveal());
        $this->view->setLocationDir(vfsStream::url('module'));
    }

    public function createAction($actionName, $userType = 'all')
    {
        return new Action([
            'name' => $actionName,
            'controller' => new Controller(
                [
                    'name' => 'MyController',
                    'object' => '%s\Controller\MyController',
                    'db' => 'My',
                    'user' => $userType
                ***REMOVED***
            ),
        ***REMOVED***);
    }

    /**
     * @group ppfx
     * @dataProvider setUpBasicColumn
     */
    public function testCreateAction($columns)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->view->setColumnService($columns);

        $action = $this->createAction('Create');

        $file = $this->view->createActionAdd($action);

        $this->assertStringEndsWith('create.phtml', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/create.phtml'),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider setUpBasicColumn
     */
    public function testEditAction($columns)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $db = new Db(['table' => 'My'***REMOVED***);

        $this->view->setColumnService($columns);

        $action = $this->createAction('Edit');

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->verifyTableAssociation('My')->willReturn(false)->shouldBeCalled();

        $this->view->setTableService($this->table->reveal());

        $file = $this->view->createActionEdit($action);

        $this->assertStringEndsWith('edit.phtml', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/edit.phtml'),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider setUpBasicColumn
     */
    public function testSearchForm($columns)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $db = new Db(['table' => 'My'***REMOVED***);

        $this->view->setColumnService($columns);

        $action = $this->createAction('SearchForm');

        $file = $this->view->createSearch($action);

        $this->assertStringEndsWith('search-form.phtml', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/search-form.phtml'),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider setUpBasicColumn
     */
    public function testViewAction($columns)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $db = new Db(['table' => 'My'***REMOVED***);

        $this->view->setColumnService($columns);

        $action = $this->createAction('View');

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->verifyTableAssociation('My')->willReturn(false)->shouldBeCalled();

        $this->view->setTableService($this->table->reveal());

        $file = $this->view->createActionView($action);

        $this->assertStringEndsWith('view.phtml', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/view.phtml'),
            file_get_contents($file)
        );
    }


    public function getListDbUserType()
    {
        $dbs = [***REMOVED***;

        foreach (['low-strict', 'all', 'strict'***REMOVED*** as $userType) {
            $dbs[***REMOVED*** = [
                new Db(['table' => 'My', 'user' => $userType***REMOVED***), $this->setUpBasicColumn(null, $userType)[0***REMOVED***[0***REMOVED***, sprintf('list-%s', $userType), $userType
            ***REMOVED***;
        }

        return $dbs;
    }


    /**
     * @group fixR
     * @dataProvider getListDbUserType
     */
    public function testListAction($db, $columns, $template, $userType)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        //$db = new Db(['table' => 'My'***REMOVED***);

        $this->view->setColumnService($columns);

        $action = $this->createAction('List', $userType);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        //$this->table->verifyTableAssociation('My')->willReturn(false)->shouldBeCalled();
        $this->table->getPrimaryKeyColumnName('My')->willreturn('id_my')->shouldBeCalled();

        $this->view->setTableService($this->table->reveal());

        $file = $this->view->createListView($action);

        $this->assertStringEndsWith('list.phtml', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/'.$template.'.phtml'),
            file_get_contents($file)
        );
    }


    /**
     * @group Action
     */
    public function testBuildAction()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(
                [
                    'name' => 'MyController',
                    'object' => '%s\Controller\MyController'
                ***REMOVED***
            )
        ***REMOVED***);

        $file = $this->view->build($action);

        $this->assertStringEndsWith('/my/my-action.phtml', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/action.phtml'),
            file_get_contents($file)
        );
    }
}
