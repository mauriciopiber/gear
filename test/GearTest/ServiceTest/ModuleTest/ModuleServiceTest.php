<?php
namespace Gear\ServiceTest\Module;

use GearTest\AbstractGearTest;
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;
use Zend\Console\Request;
use Zend\Mvc\MvcEvent;
use Gear\Service\AbstractService;
use GearTest\ServiceTest\AbstractServiceTest;

class ModuleServiceTest extends AbstractServiceTest
{
    public function testModuleServiceByServiceLocator()
    {
        $this->assertInstanceOf('Gear\Service\Module\ModuleService', $this->moduleService);
    }

    public function testHasInjectedCorrectlyFileService()
    {

        $fileService = $this->moduleService->getFileService();
        $this->assertInstanceOf('Gear\Service\Filesystem\FileService', $fileService);
    }

    public function testHasInjectedCorrectlyDirService()
    {
        $stringService = $this->moduleService->getDirService();
        $this->assertInstanceOf('Gear\Service\Filesystem\DirService', $stringService);
    }

    public function testCreateLighModule()
    {
        $module = $this->moduleService->createLight();

        $this->assertFileExists($this->structure->getMainFolder());
        $this->assertFileExists($this->structure->getConfigFolder().'/module.config.php');
        $this->assertFileExists($this->structure->getMainFolder().'/Module.php');
        $this->assertFileExists($this->structure->getSrcModuleFolder().'/Module.php');

        $applicationConfig = $this->moduleService->getApplicationConfigArray();

        $this->assertContains($this->config->getModule(), $applicationConfig['modules'***REMOVED***);

        $oReflectionClass = new \ReflectionClass('TestModule\Module');

        $this->assertEquals('TestModule\Module', $oReflectionClass->getName());
        $this->assertTrue($oReflectionClass->hasMethod('getLocation'));
        $this->assertTrue($oReflectionClass->hasMethod('getConfig'));
        $this->assertTrue($oReflectionClass->hasMethod('getAutoloaderConfig'));

        $this->moduleService->unregisterModule();
    }

}
