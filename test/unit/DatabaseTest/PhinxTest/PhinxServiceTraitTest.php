<?php
namespace GearTest\DatabaseTest\PhinxTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Database\Phinx\PhinxServiceTrait;

/**
 * @group Gear
 * @group PhinxService
 * @group Service
 */
class PhinxServiceTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use PhinxServiceTrait;

    public function setUp() : void
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Database\Phinx\PhinxService');
        $serviceManager->setService('Gear\Database\Phinx\PhinxService', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getPhinxService();
        $this->assertInstanceOf('Gear\Database\Phinx\PhinxService', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Database\Phinx\PhinxService')->reveal();
        $this->setPhinxService($mocking);
        $this->assertEquals($mocking, $this->getPhinxService());
    }
}
