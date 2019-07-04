<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite;

/**
 * @group Service
 *
 */
class SrcMvcSuiteTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->srcMvcGenerator = $this->prophesize(SrcMvcGenerator::class);
        $this->superTestFile = $this->prophesize(SuperTestFile::class);

        $this->service = new SrcMvcSuite(
            $this->srcMvcGenerator->reveal(),
            $this->superTestFile->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite', $this->service);
    }
}
