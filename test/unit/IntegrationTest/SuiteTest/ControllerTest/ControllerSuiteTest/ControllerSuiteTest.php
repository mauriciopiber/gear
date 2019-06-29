<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite;

/**
 * @group Service
 */
class ControllerSuiteTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->controllerGenerator = $this->prophesize(ControllerGenerator::class);
        $this->superTestFile = $this->prophesize(SuperTestFile::class);

        $this->service = new ControllerSuite(
            $this->controllerGenerator->reveal(),
            $this->superTestFile->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite', $this->service);
    }
}
