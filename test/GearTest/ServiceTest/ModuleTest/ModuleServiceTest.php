<?php
namespace Gear\ServiceTest\Module;

use GearTest\AbstractGearTest;

class ModuleServiceTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();
        $moduleService = $this->getServiceLocator()->get('moduleService');
        $this->moduleService = $moduleService;
    }

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

    public function testRegisterModule()
    {
        $register = $this->moduleService->registerModule();
        $this->assertModulesLoaded(array('Application'));
    }

    public function testUnregisterModule()
    {
        $register = $this->moduleService->unregisterModule();
        $this->assertNotModulesLoaded(array('Application'));
    }

    public function testLoadModule()
    {
        $register = $this->moduleService->load();
        $this->assertModulesLoaded(array('Application'));
    }

    public function testUnloadModule()
    {
        $register = $this->moduleService->unload();
        $this->assertNotModulesLoaded(array('Application'));
    }

    public function testloadBeforeModule()
    {
        $data = array('before' => 'gear');
        $register = $this->moduleService->load($data);
        $this->assertModulesLoaded(array('Application'));
    }

}
