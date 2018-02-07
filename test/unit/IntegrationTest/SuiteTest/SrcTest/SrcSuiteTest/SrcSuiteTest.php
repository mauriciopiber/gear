<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcSuiteTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuite;

/**
 * @group Service
 */
class SrcSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->srcGenerator = $this->prophesize('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator');
        $this->superTestFile = $this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile');

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
