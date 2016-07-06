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

    public function testBuildViewAction()
    {
        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => new Db(['table' => 'MyController'***REMOVED***)
        ***REMOVED***);

        $this->feature->setModule($this->module->reveal());

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
