<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Mvc
 * @group Trait
 */
class TraitTestServiceTraitTest extends AbstractTestCase
{
    use \Gear\Mvc\TraitTestServiceTrait;

    /**
     * @group Gear
     * @group ComposerUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTraitTestService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mockComposerUpgrade = $this->prophesize(
            'Gear\Mvc\TraitTestService'
        )->reveal();
        $this->setTraitTestService($mockComposerUpgrade);
        $this->assertEquals($mockComposerUpgrade, $this->getTraitTestService());
    }

}
