<?php
namespace GearTest\DiagnosticTest\FileTest;

use GearBaseTest\AbstractTestCase;
use Gear\Diagnostic\File\FileServiceTrait;

/**
 * @group Gear
 * @group Diagnostic
 * @group FileService
 */
class FileServiceTraitTest extends AbstractTestCase
{
    use FileServiceTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getFileDiagnosticService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Diagnostic\File\FileService')->reveal();
        $this->setFileDiagnosticService($mocking);
        $this->assertEquals($mocking, $this->getFileDiagnosticService());
    }
}
