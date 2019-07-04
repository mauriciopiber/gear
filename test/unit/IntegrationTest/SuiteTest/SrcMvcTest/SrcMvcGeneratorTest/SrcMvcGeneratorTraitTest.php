<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGeneratorTrait;

/**
 * @group Gear
 * @group SrcMvcGenerator
 * @group Service
 */
class SrcMvcGeneratorTraitTest extends TestCase
{

    use SrcMvcGeneratorTrait;

    public function testGet()
    {
        $serviceLocator = $this->getSrcMvcGenerator();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(SrcMvcGenerator::class)->reveal();
        $this->setSrcMvcGenerator($mocking);
        $this->assertEquals($mocking, $this->getSrcMvcGenerator());
    }
}
