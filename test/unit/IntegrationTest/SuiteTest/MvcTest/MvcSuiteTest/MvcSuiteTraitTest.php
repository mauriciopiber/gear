<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcSuiteTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuiteTrait;

/**
 * @group Gear
 * @group MvcSuite
 * @group Service
 */
class MvcSuiteTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use MvcSuiteTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite');
        $serviceManager->setService('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getMvcSuite();
        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite')->reveal();
        $this->setMvcSuite($mocking);
        $this->assertEquals($mocking, $this->getMvcSuite());
    }
}
