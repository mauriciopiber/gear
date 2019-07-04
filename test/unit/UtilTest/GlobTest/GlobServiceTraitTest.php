<?php
namespace GearTest\UtilTest\GlobTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Glob\GlobService;
use Zend\ServiceManager\ServiceManager;
use Gear\Util\Glob\GlobServiceTrait;

/**
 * @group Gear
 * @group GlobService
 * @group Service
 */
class GlobServiceTraitTest extends TestCase
{

    use GlobServiceTrait;

    public function testGet()
    {
        $serviceLocator = $this->getGlobService();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(GlobService::class)->reveal();
        $this->setGlobService($mocking);
        $this->assertEquals($mocking, $this->getGlobService());
    }
}
