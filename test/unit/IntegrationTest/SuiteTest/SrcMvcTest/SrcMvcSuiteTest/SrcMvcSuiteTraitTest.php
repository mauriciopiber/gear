<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuiteTrait;

/**
 * @group Gear
 * @group SrcMvcSuite
 * @group Service
 */
class SrcMvcSuiteTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use SrcMvcSuiteTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite');
        $serviceManager->setService('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getSrcMvcSuite();
        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite')->reveal();
        $this->setSrcMvcSuite($mocking);
        $this->assertEquals($mocking, $this->getSrcMvcSuite());
    }
}
