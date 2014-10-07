<?php
namespace Gear\ServiceTest\Module;

use GearTest\AbstractGearTest;

class ModuleServiceTest extends AbstractGearTest
{
    public function testModuleServiceByServiceLocator()
    {
        $moduleService = $this->getServiceLocator()->get('moduleService');
        $this->assertInstanceOf('Gear\Service\Module\ModuleService', $moduleService);
    }

    public function testHasInjectedCorrectlyFileService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleService');
        $fileService = $moduleService->getFileService();
        $this->assertInstanceOf('Gear\Service\Filesystem\FileService', $fileService);
    }

    public function testHasInjectedCorrectlyDirService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleService');
        $stringService = $moduleService->getDirService();
        $this->assertInstanceOf('Gear\Service\Filesystem\DirService', $stringService);
    }

    public function testCreateModule()
    {
        $moduleService = $this->getServiceLocator()->get('moduleService');

    }
}
