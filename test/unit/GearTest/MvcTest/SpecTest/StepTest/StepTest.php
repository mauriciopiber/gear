<?php
namespace GearTest\MvcTest\SpecTest\StepTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Spec\Step\StepTrait;

/**
 * @group Service
 */
class StepTest extends AbstractTestCase
{
    use StepTrait;

    /**
     * @group Gear
     * @group Step
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getStep()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group Step
    */
    public function testGet()
    {
        $step = $this->getStep();
        $this->assertInstanceOf('Gear\Mvc\Spec\Step\Step', $step);
    }

    /**
     * @group Gear
     * @group Step
    */
    public function testSet()
    {
        $mockStep = $this->getMockSingleClass(
            'Gear\Mvc\Spec\Step\Step'
        );
        $this->setStep($mockStep);
        $this->assertEquals($mockStep, $this->getStep());
    }
}
