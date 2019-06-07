<?php
namespace GearTest\IntegrationTest\UtilTest\PersistTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Util\Persist\PersistTrait;

/**
 * @group Gear
 * @group Persist
 * @group Service
 */
class PersistTraitTest extends TestCase
{

    use PersistTrait;

    public function testGet()
    {
        $serviceLocator = $this->getPersist();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Util\Persist\Persist')->reveal();
        $this->setPersist($mocking);
        $this->assertEquals($mocking, $this->getPersist());
    }
}
