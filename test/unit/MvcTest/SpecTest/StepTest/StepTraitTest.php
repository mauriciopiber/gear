<?php
namespace GearTest\MvcTest\SpecTest\StepTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Spec\Step\StepTrait;

/**
 * @group Gear
 * @group Step
 */
class StepTraitTest extends TestCase
{
    use StepTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Spec\Step\Step')->reveal();
        $this->setStep($mocking);
        $this->assertEquals($mocking, $this->getStep());
    }
}
