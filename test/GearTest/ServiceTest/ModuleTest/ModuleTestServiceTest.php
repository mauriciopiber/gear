<?php
namespace Gear\ServiceTest\ModuleTest;

use GearTest\AbstractGearTest;

class ModuleTestServiceTest extends AbstractGearTest
{
    public function testModuleTestServiceByServiceLocator()
    {
        $moduleTestService = $this->getServiceLocator()->get('moduleTestService');
        $this->assertInstanceOf('Gear\Service\Module\ModuleTestService', $moduleTestService);
    }

    public function testHasInjectedCorrectlyFileService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleTestService');
        $fileService = $moduleService->getFileService();
        $this->assertInstanceOf('Gear\Service\Filesystem\FileService', $fileService);
    }

    public function testHasInjectedCorrectlyClassService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleTestService');
        $classService = $moduleService->getClassService();
        $this->assertInstanceOf('Gear\Service\Filesystem\ClassService', $classService);
    }

    public function testHasInjectedCorrectlyStringService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleTestService');
        $stringService = $moduleService->getStringService();
        $this->assertInstanceOf('Gear\Service\Type\StringService', $stringService);
    }


    public function testHasInjectedCorrectlyDirService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleTestService');
        $stringService = $moduleService->getDirService();
        $this->assertInstanceOf('Gear\Service\Filesystem\DirService', $stringService);
    }
}
