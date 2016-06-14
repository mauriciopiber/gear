<?php
namespace GearTest\MvcTest\SpecTest\FeatureTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Spec\Feature\FeatureTrait;

/**
 * @group Service
 */
class FeatureTest extends AbstractTestCase
{
    use FeatureTrait;

    /**
     * @group Gear
     * @group Feature
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getFeature()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group Feature
    */
    public function testGet()
    {
        $feature = $this->getFeature();
        $this->assertInstanceOf('Gear\Mvc\Spec\Feature\Feature', $feature);
    }

    /**
     * @group Gear
     * @group Feature
    */
    public function testSet()
    {
        $mockFeature = $this->getMockSingleClass(
            'Gear\Mvc\Spec\Feature\Feature'
        );
        $this->setFeature($mockFeature);
        $this->assertEquals($mockFeature, $this->getFeature());
    }
}
