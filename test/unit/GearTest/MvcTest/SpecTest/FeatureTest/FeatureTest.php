<?php
namespace GearTest\MvcTest\SpecTest\FeatureTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

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
    }

    /**
     * @group Action
     */
    public function testCreateAction()
    {
        $feature = new \Gear\Mvc\Spec\Feature\Feature();
        $feature->setModule($this->module->reveal());
        $feature->setStringService($this->string);
        $feature->setFileCreator($this->fileCreator);
        $feature->setDirService($this->dir);
        $feature->setGearVersion('0.0.99');

        $action = new \GearJson\Action\Action([
            'name' => 'MyAction',
            'controller' => 'MyController'
        ***REMOVED***);

        $file = $feature->build($action);

        $this->assertStringEndsWith('/my-controller/my-action.feature', $file);

        $this->assertEquals(
            file_get_contents($this->template.'/action.feature.phtml'),
            file_get_contents($file)
        );
    }

    public function testCreateIndexFeature()
    {
        $feature = new \Gear\Mvc\Spec\Feature\Feature();
        $feature->setModule($this->module->reveal());
        $feature->setStringService($this->string);
        $feature->setFileCreator($this->fileCreator);



        $file = $feature->createIndexFeature();

        $expected = $this->template.'/module.feature.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    public function testCreateIndexFeatureProject()
    {

        $feature = new \Gear\Mvc\Spec\Feature\Feature();
        $feature->setModule($this->module->reveal());
        $feature->setStringService($this->string);
        $feature->setFileCreator($this->fileCreator);


        $file = $feature->createIndexFeature('MyProject');

        $expected = $this->template.'/module.feature.project.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }
}
