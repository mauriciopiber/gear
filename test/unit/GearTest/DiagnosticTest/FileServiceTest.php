<?php
namespace GearTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use Gear\Diagnostic\FileServiceTrait;

/**
 * @group Service
 */
class FileServiceTest extends AbstractTestCase
{
    use FileServiceTrait;

    /**
     * @group Gear
     * @group FileService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getFileService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group FileService
    */
    public function testGet()
    {
        $fileService = $this->getFileService();
        $this->assertInstanceOf('Gear\Diagnostic\FileService', $fileService);
    }

    /**
     * @group Gear
     * @group FileService
    */
    public function testSet()
    {
        $mockFileService = $this->getMockSingleClass(
            'Gear\Diagnostic\FileService'
        );
        $this->setFileService($mockFileService);
        $this->assertEquals($mockFileService, $this->getFileService());
    }
}
