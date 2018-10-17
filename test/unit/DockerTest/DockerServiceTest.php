<?php
namespace GearTest\DockerTest;

use PHPUnit\Framework\TestCase;
use Gear\Docker\DockerService;

/**
 * @group Service
 */
class DockerServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');

        $this->service = new DockerService(
            $this->stringService->reveal(),
            $this->fileCreator->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Docker\DockerService', $this->service);
    }
}
