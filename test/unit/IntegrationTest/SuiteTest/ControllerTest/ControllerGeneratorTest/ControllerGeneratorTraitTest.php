<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerGeneratorTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGeneratorTrait;

/**
 * @group Gear
 * @group ControllerGenerator
 * @group Service
 */
class ControllerGeneratorTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use ControllerGeneratorTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator');
        $serviceManager->setService('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getControllerGenerator();
        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator')->reveal();
        $this->setControllerGenerator($mocking);
        $this->assertEquals($mocking, $this->getControllerGenerator());
    }
}
