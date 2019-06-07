<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcGeneratorTest;

use PHPUnit\Framework\TestCase;
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
        $mocking = $this->prophesize('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator')->reveal();
        $this->setSrcGenerator($mocking);
        $this->assertEquals($mocking, $this->getSrcGenerator());
    }
}
