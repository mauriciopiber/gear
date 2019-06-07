<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite;

/**
 * @group Service
 */
class MvcSuiteTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->mvcGenerator = $this->prophesize('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator');
        $this->superTestFile = $this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile');

        $this->service = new MvcSuite(
            $this->mvcGenerator->reveal(),
            $this->superTestFile->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite', $this->service);
    }
}
