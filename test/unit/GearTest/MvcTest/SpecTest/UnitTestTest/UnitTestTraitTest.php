<?php
namespace GearTest\MvcTest\SpecTest\UnitTestTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Spec\UnitTest\UnitTestTrait;

/**
 * @group Gear
 * @group UnitTest
 */
class UnitTestTraitTest extends AbstractTestCase
{
    use UnitTestTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getUnitTest()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Spec\UnitTest\UnitTest')->reveal();
        $this->setUnitTest($mocking);
        $this->assertEquals($mocking, $this->getUnitTest());
    }
}
