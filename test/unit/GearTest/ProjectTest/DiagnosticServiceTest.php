<?php
namespace GearTest\ProjectTest;

use GearBaseTest\AbstractTestCase;
use Gear\Project\DiagnosticServiceTrait;

/**
 * @group Service
 */
class DiagnosticServiceTest extends AbstractTestCase
{
    use DiagnosticServiceTrait;

    /**
     * @group Gear
     * @group DiagnosticService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getDiagnosticService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group DiagnosticService
    */
    public function testGet()
    {
        $diagnosticService = $this->getDiagnosticService();
        $this->assertInstanceOf('Gear\Project\DiagnosticService', $diagnosticService);
    }

    /**
     * @group Gear
     * @group DiagnosticService
    */
    public function testSet()
    {
        $mockDiagnostic = $this->getMockSingleClass(
            'Gear\Project\DiagnosticService'
        );
        $this->setDiagnosticService($mockDiagnostic);
        $this->assertEquals($mockDiagnostic, $this->getDiagnosticService());
    }
}
