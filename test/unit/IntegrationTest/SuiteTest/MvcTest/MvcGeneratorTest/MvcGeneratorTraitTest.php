<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGeneratorTrait;

/**
 * @group Gear
 * @group MvcGenerator
 * @group Service
 */
class MvcGeneratorTraitTest extends TestCase
{

    use MvcGeneratorTrait;

    public function testGet()
    {
        $serviceLocator = $this->getMvcGenerator();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(MvcGenerator::class)->reveal();
        $this->setMvcGenerator($mocking);
        $this->assertEquals($mocking, $this->getMvcGenerator());
    }
}
