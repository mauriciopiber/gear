<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Action
 */
class AppControllerServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->templates = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/view/app/controller';


    }

    public function testCreateBuild()
    {

        vfsStream::setup('module');

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getPublicJsSpecEndFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $app = new \Gear\Mvc\View\App\AppControllerService();
        $app->setModule($this->module->reveal());
        $app->setStringService($this->string);
        $app->setFileCreator($this->fileCreator);


        $action = new \GearJson\Action\Action(
            [
                'name' => 'MyAction',
                'controller' => 'MyController'
            ***REMOVED***
        );


        $file = $app->build($action);


        $this->assertEquals(
            file_get_contents($this->templates.'/action.phtml'),
            file_get_contents($file)
        );
    }

}
