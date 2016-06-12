<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Module
 * @group Diagnostic
 * @group Dig
 * @group ModuleConstruct
 */
class DiagnosticServiceTraitTest extends AbstractTestCase
{
    use \Gear\Module\Diagnostic\DiagnosticServiceTrait;

    /**
     * @group Gear
     * @group ComposerUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getDiagnosticService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mockComposerUpgrade = $this->prophesize(
            'Gear\Module\Diagnostic\DiagnosticService'
        )->reveal();
        $this->setDiagnosticService($mockComposerUpgrade);
        $this->assertEquals($mockComposerUpgrade, $this->getDiagnosticService());
    }

}
