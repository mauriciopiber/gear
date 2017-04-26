<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;

/**
 * @group Service
 */
class SrcMvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->srcMvcMinorSuite = new SrcMvcMinorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite', $this->srcMvcMinorSuite);
    }
}
