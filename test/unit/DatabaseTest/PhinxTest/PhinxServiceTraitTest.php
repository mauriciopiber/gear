<?php
namespace GearTest\DatabaseTest\PhinxTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Database\Phinx\PhinxServiceTrait;

/**
 * @group Gear
 * @group PhinxService
 * @group Service
 */
class PhinxServiceTraitTest extends TestCase
{

    use PhinxServiceTrait;

    public function testGet()
    {
        $serviceLocator = $this->getPhinxService();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Database\Phinx\PhinxService')->reveal();
        $this->setPhinxService($mocking);
        $this->assertEquals($mocking, $this->getPhinxService());
    }
}
