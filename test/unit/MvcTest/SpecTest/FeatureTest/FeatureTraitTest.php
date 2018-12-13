<?php
namespace GearTest\MvcTest\SpecTest\FeatureTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Spec\Feature\FeatureTrait;

/**
 * @group Gear
 * @group Feature
 */
class FeatureTraitTest extends TestCase
{
    use FeatureTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Spec\Feature\Feature')->reveal();
        $this->setFeature($mocking);
        $this->assertEquals($mocking, $this->getFeature());
    }
}
