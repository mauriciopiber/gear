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

    public function testCreateListAction()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $db = new \GearJson\Db\Db(['table' => 'My'***REMOVED***);

        $this->columns = $this->prophesize('Gear\Column\ColumnService');
        $this->columns->getColumns($db)->willReturn([***REMOVED***)->shouldBeCalled();

        $view = new \Gear\Mvc\View\ViewService();
        $view->setDirService($this->dir);
        $view->setStringService($this->string);
        $view->setFileCreator($this->fileCreator);
        $view->setModule($this->module->reveal());
        $view->setColumnService($this->columns->reveal());
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
