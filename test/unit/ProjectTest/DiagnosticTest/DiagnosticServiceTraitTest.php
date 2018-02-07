<?php
namespace GearTest\ProjectTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use Gear\Project\Diagnostic\DiagnosticServiceTrait;

/**
 * @group Diagnostic
 * @group Service
 */
class DiagnosticServiceTraitTest extends AbstractTestCase
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
        $this->assertInstanceOf('Gear\Project\Diagnostic\DiagnosticService', $diagnosticService);
    }

    /**
     * @group Gear
     * @group DiagnosticService
    */
    public function testSet()
    {
        $mockDiagnostic = $this->getMockSingleClass(
            'Gear\Project\Diagnostic\DiagnosticService'
        );
        $this->setDiagnosticService($mockDiagnostic);
        $this->assertEquals($mockDiagnostic, $this->getDiagnosticService());
    }
}
