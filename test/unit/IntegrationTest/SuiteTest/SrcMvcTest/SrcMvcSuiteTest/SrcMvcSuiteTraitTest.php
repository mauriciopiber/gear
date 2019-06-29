<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuiteTrait;

/**
 * @group Gear
 * @group SrcMvcSuite
 * @group Service
 */
class SrcMvcSuiteTraitTest extends TestCase
{

    use SrcMvcSuiteTrait;

    public function testGet()
    {
        $serviceLocator = $this->getSrcMvcSuite();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(SrcMvcSuite::class)->reveal();
        $this->setSrcMvcSuite($mocking);
        $this->assertEquals($mocking, $this->getSrcMvcSuite());
    }
}
