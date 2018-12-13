<?php
namespace GearTest\IntegrationTest\UtilTest\PersistTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Util\Persist\PersistTrait;

/**
 * @group Gear
 * @group Persist
 * @group Service
 */
class PersistTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use PersistTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Util\Persist\Persist');
        $serviceManager->setService('Gear\Integration\Util\Persist\Persist', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getPersist();
        $this->assertInstanceOf('Gear\Integration\Util\Persist\Persist', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Util\Persist\Persist')->reveal();
        $this->setPersist($mocking);
        $this->assertEquals($mocking, $this->getPersist());
    }
}
