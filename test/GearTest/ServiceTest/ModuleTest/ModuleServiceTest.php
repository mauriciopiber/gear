<?php
namespace GearTest\ServiceTest\ModuleTest;

use GearTest\AbstractGearTest;

class ModuleServiceTest extends AbstractGearTest
{
    public function testModuleServiceByServiceLocator()
    {
        $moduleService = $this->getServiceLocator()->get('moduleService');
        $this->assertInstanceOf('Gear\Service\Module\ModuleService', $moduleService);
    }

    public function testHasInjectedCorrectlyDirService()
    {
        $moduleService = $this->getServiceLocator()->get('moduleService');
        $dirService = $moduleService->getDirService();
        $this->assertInstanceOf('Gear\Service\Filesystem\DirService',$dirService);
    }

    public function testHasInjectedCorrectlyFileService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleService');
        $fileService = $moduleService->getFileService();
        $this->assertInstanceOf('Gear\Service\Filesystem\FileService',$fileService);
    }

}
