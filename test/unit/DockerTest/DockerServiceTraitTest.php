<?php
namespace GearTest\DockerTest;

use PHPUnit\Framework\TestCase;
use Gear\Docker\DockerServiceTrait;
use Gear\Docker\DockerService;

/**
 * @group Gear
 * @group DockerService
 * @group Service
 */
class DockerServiceTraitTest extends TestCase
{
    use DockerServiceTrait;

    public function testGetEmpty()
    {
        $dockerService = $this->getDockerService();
        $this->assertNull($dockerService);
    }

    public function testSet()
    {
        $this->dockerServiceMock = $this->prophesize(DockerService::class);
        $this->setDockerService($this->dockerServiceMock->reveal());
        $dockerService = $this->getDockerService();

        $this->assertInstanceOf(
            DockerService::class,
            $dockerService
        );

        $this->assertEquals(
            $this->dockerServiceMock->reveal(),
            $dockerService
        );
    }
}
