<?php
namespace GearTest\IntegrationTest\SuiteTest\IntegrationTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Integration\Integration;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Integration\IntegrationTrait;

/**
 * @group Gear
 * @group Integration
 * @group Service
 */
class IntegrationTraitTest extends TestCase
{

    use IntegrationTrait;

    public function testGet()
    {
        $serviceLocator = $this->getIntegration();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(Integration::class)->reveal();
        $this->setIntegration($mocking);
        $this->assertEquals($mocking, $this->getIntegration());
    }
}
