<?php
namespace GearTest\MvcTest\FactoryTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Mvc
 * @group Factory
 */
class FactoryTestServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/mvc/factory';

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $stringService  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\File($fileService, $template);

        $codeTest = new \Gear\Creator\CodeTest();
        $codeTest->setModule($module->reveal());

        $this->factoryTest = new \Gear\Mvc\Factory\FactoryTestService();
        $this->factoryTest->setStringService($stringService);
        $this->factoryTest->setFileCreator($fileCreator);
        $this->factoryTest->setModule($module->reveal());
        $this->factoryTest->setCodeTest($codeTest);
    }

    public function testCreateTraitTestController()
    {
        $src = new \GearJson\Controller\Controller([
            'name' => 'MyController',
            'type' => 'Action',
            'object' => '%s\Controller\MyController'
        ***REMOVED***);

        $link = $this->factoryTest->createControllerFactoryTest($src, vfsStream::url('module'));

        $this->assertEquals('vfs://module/MyControllerFactoryTest.php', $link);

        $this->assertEquals(file_get_contents($this->templates.'/factory-controller-001.phtml'), file_get_contents($link));
    }

    public function testCreateFactoryTestFormSrc()
    {
        $src = new \GearJson\Src\Src([
            'name' => 'MyForm',
            'type' => 'Form',
            'template' => 'form-filter'
        ***REMOVED***);

        $link = $this->factoryTest->createFactoryTest($src, vfsStream::url('module'));

        $this->assertEquals('vfs://module/MyFormFactoryTest.php', $link);

        $this->assertEquals(file_get_contents($this->templates.'/form-filter.phtml'), file_get_contents($link));
    }

    public function testCreateFactoryDependency()
    {
        $src = new \GearJson\Src\Src([
            'name' => 'MyForm',
            'type' => 'Form',
            'service' => 'factories',
            'dependency' => ['Repository\MyDependencyOne', 'Service\MyDependencyTwo'***REMOVED***
        ***REMOVED***);

        $link = $this->factoryTest->createFactoryTest($src, vfsStream::url('module'));

        $this->assertEquals('vfs://module/MyFormFactoryTest.php', $link);

        $this->assertEquals(file_get_contents($this->templates.'/dependencies.phtml'), file_get_contents($link));

    }

    public function testCreateTraitTestSrc()
    {
        $src = new \GearJson\Src\Src([
            'name' => 'MyService',
            'type' => 'Service'
        ***REMOVED***);

        $link = $this->factoryTest->createFactoryTest($src, vfsStream::url('module'));

        $this->assertEquals('vfs://module/MyServiceFactoryTest.php', $link);

        $this->assertEquals(file_get_contents($this->templates.'/name-type.phtml'), file_get_contents($link));
    }

    public function testDependency()
    {
        $this->assertInstanceOf('Gear\Module\BasicModuleStructure', $this->factoryTest->getModule());
        $this->assertInstanceOf('Gear\Creator\File', $this->factoryTest->getFileCreator());
        $this->assertInstanceOf('Gear\Creator\CodeTest', $this->factoryTest->getCodeTest());
    }
}
