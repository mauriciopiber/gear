<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuite;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuiteTrait;

/**
 * @group Gear
 * @group SrcSuite
 * @group Service
 */
class SrcSuiteTraitTest extends TestCase
{

    use SrcSuiteTrait;

    public function testGet()
    {
        $serviceLocator = $this->getSrcSuite();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(SrcSuite::class)->reveal();
        $this->setSrcSuite($mocking);
        $this->assertEquals($mocking, $this->getSrcSuite());
    }
}
