<?php
namespace GearTest\MvcTest\ViewTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group View
 */
class ViewServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/view';

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->dir = new \GearBase\Util\Dir\DirService();
    }

    public function setUpBasicColumn()
    {

        $primaryKeyConst = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $primaryKeyConst->getType()->willReturn('PRIMARY KEY')->shouldBeCalled();
        $primaryKeyConst->getColumns()->willReturn(['id_my'***REMOVED***)->shouldBeCalled();

        $primaryKey = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $primaryKey->getDataType()->willReturn('int')->shouldBeCalled();
        $primaryKey->getName()->willReturn('id_my')->shouldBeCalled();
        $primaryKey->getTableName()->willReturn('my')->shouldBeCalled();

        $primaryKey = new \Gear\Column\Integer\PrimaryKey($primaryKey->reveal(), $primaryKeyConst->reveal());
        $this->string = new \GearBase\Util\String\StringService();
        $primaryKey->setStringService($this->string);

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $column->getName()->willReturn('dep_name')->shouldBeCalled();
        $column->getTableName()->willReturn('my')->shouldBeCalled();

        $foreignKey = new \Gear\Column\Varchar\Varchar($column->reveal());
        $this->string = new \GearBase\Util\String\StringService();
        $foreignKey->setStringService($this->string);

        //$columnTest = $this->prophesize('Gear\Column\Integer\ForeignKey');

        //$columns = $this->prophesize('Gear')

        $db = new \GearJson\Db\Db(['table' => 'My'***REMOVED***);

        $this->columns = $this->prophesize('Gear\Column\ColumnService');
        $this->columns->getColumns($db)->willReturn([$primaryKey, $foreignKey***REMOVED***)->shouldBeCalled();

        return [
            [
                $this->columns->reveal()
            ***REMOVED***
        ***REMOVED***;
    }

    /**
     * @group ppfx
     * @dataProvider setUpBasicColumn
     */
    public function testCreateAction($columns)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $db = new \GearJson\Db\Db(['table' => 'My'***REMOVED***);

        $view = new \Gear\Mvc\View\ViewService();
        $view->setDirService($this->dir);
        $view->setStringService($this->string);
        $view->setFileCreator($this->fileCreator);
        $view->setModule($this->module->reveal());
        $view->setColumnService($columns);
        $view->setLocationDir(vfsStream::url('module'));

        $action = new \GearJson\Action\Action([
            'name' => 'Create',
            'controller' => new \GearJson\Controller\Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $file = $view->createActionAdd($action);

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

        $db = new \GearJson\Db\Db(['table' => 'My'***REMOVED***);

        $view = new \Gear\Mvc\View\ViewService();
        $view->setDirService($this->dir);
        $view->setStringService($this->string);
        $view->setFileCreator($this->fileCreator);
        $view->setModule($this->module->reveal());
        $view->setColumnService($columns);
        $view->setLocationDir(vfsStream::url('module'));

        $action = new \GearJson\Action\Action([
            'name' => 'Create',
            'controller' => new \GearJson\Controller\Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->verifyTableAssociation('My')->willReturn(false)->shouldBeCalled();

        $view->setTableService($this->table->reveal());

        $file = $view->createActionEdit($action);

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

        $db = new \GearJson\Db\Db(['table' => 'My'***REMOVED***);

        $view = new \Gear\Mvc\View\ViewService();
        $view->setDirService($this->dir);
        $view->setStringService($this->string);
        $view->setFileCreator($this->fileCreator);
        $view->setModule($this->module->reveal());
        $view->setColumnService($columns);
        $view->setLocationDir(vfsStream::url('module'));

        $action = new \GearJson\Action\Action([
            'name' => 'Create',
            'controller' => new \GearJson\Controller\Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $file = $view->createSearch($action);

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

        $db = new \GearJson\Db\Db(['table' => 'My'***REMOVED***);

        $view = new \Gear\Mvc\View\ViewService();
        $view->setDirService($this->dir);
        $view->setStringService($this->string);
        $view->setFileCreator($this->fileCreator);
        $view->setModule($this->module->reveal());
        $view->setColumnService($columns);
        $view->setLocationDir(vfsStream::url('module'));

        $action = new \GearJson\Action\Action([
            'name' => 'Create',
            'controller' => new \GearJson\Controller\Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->verifyTableAssociation('My')->willReturn(false)->shouldBeCalled();

        $view->setTableService($this->table->reveal());

        $file = $view->createActionView($action);

        $this->assertStringEndsWith('view.phtml', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/view.phtml'),
            file_get_contents($file)
            );
    }

    /**
     * @dataProvider setUpBasicColumn
     */
    public function testListAction($columns)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $db = new \GearJson\Db\Db(['table' => 'My'***REMOVED***);

        $view = new \Gear\Mvc\View\ViewService();
        $view->setDirService($this->dir);
        $view->setStringService($this->string);
        $view->setFileCreator($this->fileCreator);
        $view->setModule($this->module->reveal());
        $view->setColumnService($columns);
        $view->setLocationDir(vfsStream::url('module'));

        $action = new \GearJson\Action\Action([
            'name' => 'Create',
            'controller' => new \GearJson\Controller\Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        //$this->table->verifyTableAssociation('My')->willReturn(false)->shouldBeCalled();
        $this->table->getPrimaryKeyColumnName('My')->willreturn('id_my')->shouldBeCalled();

        $view->setTableService($this->table->reveal());

        $file = $view->createListView($action);

        $this->assertStringEndsWith('list.phtml', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/list.phtml'),
            file_get_contents($file)
        );
    }


    /**
     * @group Action
     */
    public function testBuildAction()
    {
        /**
        $this->module->getPublicJsSpecEndFolder()
        ->willReturn(vfsStream::url('module/public/js/spec/e2e'))
        ->shouldBeCalled();
        */

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();


        $view = new \Gear\Mvc\View\ViewService();
        $view->setDirService($this->dir);
        $view->setStringService($this->string);
        $view->setFileCreator($this->fileCreator);
        $view->setModule($this->module->reveal());

        $action = new \GearJson\Action\Action([
            'name' => 'MyAction',
            'controller' => new \GearJson\Controller\Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***)
        ***REMOVED***);


        $file = $view->build($action);

        $this->assertStringEndsWith('/my/my-action.phtml', $file);


        $this->assertEquals(
            file_get_contents($this->template.'/action.phtml'),
            file_get_contents($file)
        );
    }
}
