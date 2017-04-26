<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;

/**
 * @group Service
 */
class SrcMvcMajorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->srcMvcMajorSuite = new SrcMvcMajorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite', $this->srcMvcMajorSuite);
    }
}
