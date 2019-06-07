<?php
namespace GearTest\IntegrationTest\UtilTest\ResolveNamesTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Util\ResolveNames\ResolveNamesTrait;

/**
 * @group Gear
 * @group ResolveNames
 * @group Service
 */
class ResolveNamesTraitTest extends TestCase
{

    use ResolveNamesTrait;

    public function testGet()
    {
        $serviceLocator = $this->getResolveNames();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Util\ResolveNames\ResolveNames')->reveal();
        $this->setResolveNames($mocking);
        $this->assertEquals($mocking, $this->getResolveNames());
    }
}
