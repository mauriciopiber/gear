<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGeneratorTrait;

/**
 * @group Gear
 * @group SrcGenerator
 * @group Service
 */
class SrcGeneratorTraitTest extends TestCase
{

    use SrcGeneratorTrait;

    public function testGet()
    {
        $serviceLocator = $this->getSrcGenerator();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(SrcGenerator::class)->reveal();
        $this->setSrcGenerator($mocking);
        $this->assertEquals($mocking, $this->getSrcGenerator());
    }
}
