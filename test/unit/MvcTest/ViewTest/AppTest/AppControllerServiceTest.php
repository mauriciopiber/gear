<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\UtilTestTrait;

/**
 * @group Action
 */
class AppControllerServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();

        $this->templates = (new \Gear\Module())->getLocation().'/../test/template/module/mvc/view/app/controller';
    }

    public function testCreateBuild()
    {

        vfsStream::setup('module');

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getPublicJsAppFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $this->dir = new \GearBase\Util\Dir\DirService();

        $app = new \Gear\Mvc\View\App\AppControllerService();
        $app->setModule($this->module->reveal());
        $app->setStringService($this->string);
        $app->setFileCreator($this->fileCreator);
        $app->setGearVersion('0.0.99');
        $app->setDirService($this->dir);


        $action = new \GearJson\Action\Action(
            [
                'name' => 'MyAction',
                'controller' => 'MyController'
            ***REMOVED***
        );

        $file = $app->build($action);

        $this->assertStringEndsWith('/my-controller/MyControllerMyActionAction.js', $file);

        $this->assertEquals(
            file_get_contents($this->templates.'/action.phtml'),
            file_get_contents($file)
        );
    }

}
