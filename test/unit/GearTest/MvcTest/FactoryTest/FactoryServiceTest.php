<?php
namespace GearTest\MvcTest\Factory;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Mvc
 * @group Factory
 */
class FactoryServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');


        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->template = $this->baseDir.'/../../test/template/module/mvc/factory';

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $this->string  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\File($fileService, $template);

        $code = new \Gear\Creator\Code();
        $code->setModule($this->module->reveal());
        $code->setStringService($this->string);

        $this->factory = new \Gear\Mvc\Factory\FactoryService();
        $this->factory->setStringService($this->string);
        $this->factory->setFileCreator($fileCreator);
        $this->factory->setModule($this->module->reveal());
        $this->factory->setCode($code);
    }

    public function testCreateFactoryDependency()
    {
        $location = vfsStream::url('module');

        $this->module->map('Service')->willReturn($location);


        $expected = 'dependencies';

        $src = new \GearJson\Src\Src([
            'name' => 'MyService',
            'type' => 'Service',
            'service' => 'factories',
            'dependency' => [
                'Repository\DependencyOne',
                'Service\DependencyTwo'
            ***REMOVED***
        ***REMOVED***);

        $file = $this->factory->createFactory($src, $location);

        $this->assertEquals(file_get_contents($this->template.'/'.$expected.'.phtml'), file_get_contents($file));

    }
}