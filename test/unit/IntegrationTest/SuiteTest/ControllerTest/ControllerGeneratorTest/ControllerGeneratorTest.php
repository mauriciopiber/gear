<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator;

/**
 * @group Service
 */
class ControllerGeneratorTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->gearFile = $this->prophesize(GearFile::class);
        $this->testFile = $this->prophesize(TestFile::class);

        $this->service = new ControllerGenerator(
            $this->gearFile->reveal(),
            $this->testFile->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator', $this->service);
    }
}
