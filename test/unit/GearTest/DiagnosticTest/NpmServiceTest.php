<?php
namespace GearTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use Gear\Diagnostic\NpmServiceTrait;

/**
 * @group Service
 */
class NpmServiceTest extends AbstractTestCase
{
    use NpmServiceTrait;

    /**
     * @group Gear
     * @group NpmService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getNpmService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group NpmService
    */
    public function testGet()
    {
        $npmService = $this->getNpmService();
        $this->assertInstanceOf('Gear\Diagnostic\NpmService', $npmService);
    }

    /**
     * @group Gear
     * @group NpmService
    */
    public function testSet()
    {
        $mockNpmService = $this->getMockSingleClass(
            'Gear\Diagnostic\NpmService'
        );
        $this->setNpmService($mockNpmService);
        $this->assertEquals($mockNpmService, $this->getNpmService());
    }
}
