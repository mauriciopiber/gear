<?php
namespace GearTest\MvcTest\ViewTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Schema\Controller\Controller;
use Gear\Schema\Action\Action;
use Gear\Schema\Db\Db;
use Gear\Util\String\StringService;
use Gear\Util\File\FileService;
use Gear\Util\Dir\DirService;
use Gear\Module;
use Gear\Creator\Template\TemplateService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Mvc\View\AngularService;
use GearTest\UtilTestTrait;

/**
 * @group View
 */
class AngularServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->assertFileExists(vfsStream::url('module'));

        vfsStream::newDirectory('public')->at($this->root);

        $this->assertFileExists(vfsStream::url('module/public'));

        //
        //vfsStream::newDirectory('public/js')->at($this->root);
        //vfsStream::newDirectory('public/js/spec')->at($this->root);

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->template = (new Module())->getLocation().'/../test/template/module/mvc/view/angular';

        $this->string = new StringService();

        $template = new TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new Module)->getLocation().'/../view'));

        $fileService        = new FileService();
        $this->fileCreator  = new FileCreator($fileService, $template);

        $this->dir = new DirService();

        $this->angular = new AngularService();
        $this->angular->setDirService($this->dir);
        $this->angular->setStringService($this->string);
        $this->angular->setFileCreator($this->fileCreator);
        $this->angular->setModule($this->module->reveal());
        //$this->angular->setLocationDir(vfsStream::url('module'));
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


    public function getListDbUserType()
    {
        $dbs = [***REMOVED***;

        foreach (['low-strict', 'all', 'strict'***REMOVED*** as $userType) {
            $dbs[***REMOVED*** = [
                new Db(['table' => 'My', 'user' => $userType***REMOVED***), sprintf('list-%s', $userType), $userType
            ***REMOVED***;
        }

        return $dbs;
    }


    /**
     * @group fixR
     * @dataProvider getListDbUserType
     */
    public function testListAction($db, $template, $userType)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getPublicJsControllerFolder()->willReturn(vfsStream::url('module/public'))->shouldBeCalled();

        //$this->angular->setColumnService($columns);

        $action = $this->createAction('List', $userType);

        $file = $this->angular->createListAction($action);

        $this->assertStringEndsWith('MyListController.js', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/'.$template.'.phtml'),
            file_get_contents($file)
        );
    }
}
