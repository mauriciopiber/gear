<?php
namespace GearTest\IntegrationTest\SuiteTest\IntegrationTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Integration\IntegrationTrait;

/**
 * @group Gear
 * @group Integration
 * @group Service
 */
class IntegrationTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use IntegrationTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\Integration\Integration');
        $serviceManager->setService('Gear\Integration\Suite\Integration\Integration', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getIntegration();
        $this->assertInstanceOf('Gear\Integration\Suite\Integration\Integration', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Integration\Integration')->reveal();
        $this->setIntegration($mocking);
        $this->assertEquals($mocking, $this->getIntegration());
    }
}
