<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Src\SrcMinorSuite;

/**
 * @group Service
 */
class SrcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->srcMinorSuite = new SrcMinorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcMinorSuite', $this->srcMinorSuite);
    }
}
