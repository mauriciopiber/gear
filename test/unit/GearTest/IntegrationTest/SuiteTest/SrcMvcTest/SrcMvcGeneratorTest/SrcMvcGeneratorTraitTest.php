<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcGeneratorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGeneratorTrait;

/**
 * @group Gear
 * @group SrcMvcGenerator
 * @group Service
 */
class SrcMvcGeneratorTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use SrcMvcGeneratorTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator');
        $serviceManager->setService('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getSrcMvcGenerator();
        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator')->reveal();
        $this->setSrcMvcGenerator($mocking);
        $this->assertEquals($mocking, $this->getSrcMvcGenerator());
    }
}
