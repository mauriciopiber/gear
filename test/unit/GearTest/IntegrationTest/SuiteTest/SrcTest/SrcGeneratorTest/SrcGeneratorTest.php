<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcGeneratorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator;
use Gear\Integration\Suite\Src\SrcMajorSuite;
use Gear\Integration\Suite\Src\SrcMinorSuite;

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

        $this->suite = $this->prophesize('Gear\Integration\Suite\MinorSuiteInterface');
        $this->suite->isUsingLongName()->willReturn(true);
    }
}
