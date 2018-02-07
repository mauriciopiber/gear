<?php
namespace GearTest\MvcTest\SpecTest\FeatureTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Spec\Feature\FeatureTrait;

/**
 * @group Gear
 * @group Feature
 */
class FeatureTraitTest extends AbstractTestCase
{
    use FeatureTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getFeature()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Spec\Feature\Feature')->reveal();
        $this->setFeature($mocking);
        $this->assertEquals($mocking, $this->getFeature());
    }
}
