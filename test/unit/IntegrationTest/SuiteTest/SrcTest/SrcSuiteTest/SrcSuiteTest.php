<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuite;

/**
 * @group Service
 */
class SrcSuiteTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->srcGenerator = $this->prophesize(SrcGenerator::class);
        $this->superTestFile = $this->prophesize(SuperTestFile::class);

        $this->service = new SrcSuite(
            $this->srcGenerator->reveal(),
            $this->superTestFile->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcSuite\SrcSuite', $this->service);
    }
}
