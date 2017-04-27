<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcGeneratorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGeneratorTrait;

/**
 * @group Gear
 * @group MvcGenerator
 * @group Service
 */
class MvcGeneratorTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use MvcGeneratorTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator');
        $serviceManager->setService('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getMvcGenerator();
        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator')->reveal();
        $this->setMvcGenerator($mocking);
        $this->assertEquals($mocking, $this->getMvcGenerator());
    }
}
