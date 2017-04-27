<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcGeneratorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator;

/**
 * @group Service
 */
class SrcGeneratorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gearFile = $this->prophesize('Gear\Integration\Component\GearFile\GearFile');
        $this->testFile = $this->prophesize('Gear\Integration\Component\TestFile\TestFile');

        $this->service = new SrcGenerator(
            $this->gearFile->reveal(),
            $this->testFile->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator', $this->service);
    }
}
