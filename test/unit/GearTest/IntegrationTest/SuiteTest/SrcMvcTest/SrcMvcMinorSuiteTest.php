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
        $this->majorSuite = $this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite');
        $this->srcMvcMinorSuite = new SrcMvcMinorSuite($this->majorSuite->reveal(), 'service', null, null, null, null, true);
    }

    public function testCreateMinorSuite()
    {
        $this->majorSuite->getSuite()->willReturn('src-mvc')->shouldBeCalled();
        $this->assertEquals($this->majorSuite->reveal(), $this->srcMvcMinorSuite->getMajorSuite());
        $this->assertEquals('service', $this->srcMvcMinorSuite->getType());
        $this->assertEquals('src-mvc/src-mvc-service', $this->srcMvcMinorSuite->getLocationKey());
        $this->assertTrue($this->srcMvcMinorSuite->isUsingLongName());
        //$this->assertEquals('service', $this->srcMvcMinorSuite->getType());
    }
}
