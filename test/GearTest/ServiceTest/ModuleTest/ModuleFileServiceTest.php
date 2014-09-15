<?php
namespace Gear\ServiceTest\ModuleTest;

use GearTest\AbstractGearTest;

class ModuleFileServiceTest extends AbstractGearTest
{
    public function testModuleFileServiceByServiceLocator()
    {
        $moduleFileService = $this->getServiceLocator()->get('moduleFileService');
        $this->assertInstanceOf('Gear\Service\Module\ModuleFileService', $moduleFileService);
    }

    public function testHasInjectedCorrectlyFileService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleFileService');
        $fileService = $moduleService->getFileService();
        $this->assertInstanceOf('Gear\Service\Filesystem\FileService', $fileService);
    }

    public function testHasInjectedCorrectlyClassService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleFileService');
        $classService = $moduleService->getClassService();
        $this->assertInstanceOf('Gear\Service\Filesystem\ClassService', $classService);
    }

    public function testHasInjectedCorrectlyStringService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('moduleFileService');
        $stringService = $moduleService->getStringService();
        $this->assertInstanceOf('Gear\Service\Type\StringService', $stringService);
    }
}
