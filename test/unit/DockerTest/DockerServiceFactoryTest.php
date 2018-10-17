<?php
namespace GearTest\DockerTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Docker\DockerServiceFactory;
use Gear\Docker\DockerService;
use GearBase\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;

/**
 * @group Gear
 * @group DockerService
 * @group Service
 */
class DockerServiceFactoryTest extends TestCase
{
    public function testDockerServiceFactory()
    {
        $this->serviceLocator = $this->prophesize(ServiceLocatorInterface::class);

        $this->serviceLocator->get('GearBase\Util\String')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $factory = new DockerServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(DockerService::class, $instance);
    }
}
