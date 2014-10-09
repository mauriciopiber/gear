<?php
namespace Gear\ServiceTest\ModuleTest;

use GearTest\AbstractGearTest;

class ModuleTestServiceTest extends AbstractGearTest
{

    public function testHasInjectedCorrectlyFileService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('testService');
        $fileService = $moduleService->getFileService();
        $this->assertInstanceOf('Gear\Service\Filesystem\FileService', $fileService);
    }

    public function testHasInjectedCorrectlyClassService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('testService');
        $classService = $moduleService->getClassService();
        $this->assertInstanceOf('Gear\Service\Filesystem\ClassService', $classService);
    }

    public function testHasInjectedCorrectlyStringService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('testService');
        $stringService = $moduleService->getStringService();
        $this->assertInstanceOf('Gear\Service\Type\StringService', $stringService);
    }

    public function testHasInjectedCorrectlyDirService()
    {
        /* @var $moduleService \Gear\Service\Module\ModuleService */
        $moduleService = $this->getServiceLocator()->get('testService');
        $stringService = $moduleService->getDirService();
        $this->assertInstanceOf('Gear\Service\Filesystem\DirService', $stringService);
    }
}
