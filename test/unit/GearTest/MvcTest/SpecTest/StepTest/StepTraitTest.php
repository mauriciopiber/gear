<?php
namespace GearTest\MvcTest\SpecTest\StepTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Spec\Step\StepTrait;

/**
 * @group Gear
 * @group Step
 */
class StepTraitTest extends AbstractTestCase
{
    use StepTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getStep()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Spec\Step\Step')->reveal();
        $this->setStep($mocking);
        $this->assertEquals($mocking, $this->getStep());
    }
}
