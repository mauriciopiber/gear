<?php
namespace GearTest\UtilTest\GlobTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Util\Glob\GlobServiceTrait;

/**
 * @group Gear
 * @group GlobService
 * @group Service
 */
class GlobServiceTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use GlobServiceTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Util\Glob\GlobService');
        $serviceManager->setService('Gear\Util\Glob\GlobService', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getGlobService();
        $this->assertInstanceOf('Gear\Util\Glob\GlobService', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Util\Glob\GlobService')->reveal();
        $this->setGlobService($mocking);
        $this->assertEquals($mocking, $this->getGlobService());
    }
}
