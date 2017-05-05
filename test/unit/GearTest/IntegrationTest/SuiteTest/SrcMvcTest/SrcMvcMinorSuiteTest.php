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

        $this->majorSuite = $this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite');
    }

    public function testCreateMinorSuite()
    {
        $this->srcMvcMinorSuite = new SrcMvcMinorSuite($this->majorSuite->reveal(), 'service');

        $this->assertEquals($this->majorSuite->reveal(), $this->srcMvcMinorSuite->getMajorSuite());
        $this->assertEquals('service', $this->srcMvcMinorSuite->getType());
    }
}
