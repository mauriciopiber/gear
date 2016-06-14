<?php
namespace GearTest\MvcTest\SpecTest\UnitTestTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Spec\UnitTest\UnitTestTrait;

/**
 * @group Service
 */
class UnitTestTest extends AbstractTestCase
{
    use UnitTestTrait;

    /**
     * @group Gear
     * @group UnitTest
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getUnitTest()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group UnitTest
    */
    public function testGet()
    {
        $unitTest = $this->getUnitTest();
        $this->assertInstanceOf('Gear\Mvc\Spec\UnitTest\UnitTest', $unitTest);
    }

    /**
     * @group Gear
     * @group UnitTest
    */
    public function testSet()
    {
        $mockUnitTest = $this->getMockSingleClass(
            'Gear\Mvc\Spec\UnitTest\UnitTest'
        );
        $this->setUnitTest($mockUnitTest);
        $this->assertEquals($mockUnitTest, $this->getUnitTest());
    }
}
