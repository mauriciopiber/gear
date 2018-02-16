<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Api\ApiControllerServiceFactory;
use Gear\Mvc\Controller\Api\ApiControllerService;
use Gear\Module\Structure\ModuleStructure;
use GearBase\Util\String\StringService;
use Gear\Creator\Code;
use Gear\Creator\FileCreator\FileCreator;

/**
 * @group Gear
 * @group ApiControllerService
 * @group Service
 */
class ApiControllerServiceFactoryTest extends TestCase
{
    public function testApiControllerServiceFactory()
    {
        $this->serviceLocator = $this->prophesize(ServiceLocatorInterface::class);

        $this->serviceLocator->get(ModuleStructure::class)
            ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(Code::class)
            ->willReturn($this->prophesize(Code::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();
        $factory = new ApiControllerServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(ApiControllerService::class, $instance);
    }
}
