<?php
namespace GearTest\IntegrationTest\UtilTest\ResolveNamesTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Util\ResolveNames\ResolveNamesTrait;

/**
 * @group Gear
 * @group ResolveNames
 * @group Service
 */
class ResolveNamesTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use ResolveNamesTrait;

    public function setUp() : void
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Util\ResolveNames\ResolveNames');
        $serviceManager->setService('Gear\Integration\Util\ResolveNames\ResolveNames', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getResolveNames();
        $this->assertInstanceOf('Gear\Integration\Util\ResolveNames\ResolveNames', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Util\ResolveNames\ResolveNames')->reveal();
        $this->setResolveNames($mocking);
        $this->assertEquals($mocking, $this->getResolveNames());
    }
}
