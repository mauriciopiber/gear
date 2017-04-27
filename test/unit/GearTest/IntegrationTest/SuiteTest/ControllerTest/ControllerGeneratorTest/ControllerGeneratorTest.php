<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerGeneratorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator;

/**
 * @group Service
 */
class ControllerGeneratorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gearFile = $this->prophesize('Gear\Integration\Component\GearFile\GearFile');
        $this->testFile = $this->prophesize('Gear\Integration\Component\TestFile\TestFile');

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
