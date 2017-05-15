<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;

/**
 * @group MinorSuite
 * @group Suite
 */
class SrcMvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->majorSuite = new SrcMvcMajorSuite();
        $this->srcMvcMinorSuite = new SrcMvcMinorSuite($this->majorSuite, 'service');
    }

    public function testCreateMinorSuite()
    {
        $this->assertEquals($this->majorSuite, $this->srcMvcMinorSuite->getMajorSuite());

        //$this->assertEquals($this->majorSuite->reveal(), $this->srcMvcMinorSuite->getMajorSuite());
        //$this->assertEquals('service', $this->srcMvcMinorSuite->getType());
    }
}
