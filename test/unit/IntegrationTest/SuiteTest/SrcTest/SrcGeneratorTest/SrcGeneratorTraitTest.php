<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGeneratorTrait;

/**
 * @group Gear
 * @group SrcGenerator
 * @group Service
 */
class SrcGeneratorTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use SrcGeneratorTrait;

    public function setUp() : void
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator');
        $serviceManager->setService('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getSrcGenerator();
        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator')->reveal();
        $this->setSrcGenerator($mocking);
        $this->assertEquals($mocking, $this->getSrcGenerator());
    }
}
