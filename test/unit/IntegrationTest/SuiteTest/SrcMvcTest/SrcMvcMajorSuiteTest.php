<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;

/**
 * @group MajorSuite
 * @group Suite
 */
class SrcMvcMajorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

    }

    public function testClassExists()
    {
        $this->srcMvcMajorSuite = new SrcMvcMajorSuite(['basic'***REMOVED***, ['all'***REMOVED***, ['nullable'***REMOVED***, [null***REMOVED***);

        $this->assertEquals('src-mvc', $this->srcMvcMajorSuite->getSuperType());
        $this->assertEquals('src-mvc', $this->srcMvcMajorSuite->getSuite());
        $this->assertEquals('src-mvc', $this->srcMvcMajorSuite->getLocationKey());
        //$this->assertEquals(['basic'***REMOVED***, $this->srcMvcMajorSuite->getColumns());
        //$this->assertEquals(['all'***REMOVED***, $this->srcMvcMajorSuite->getUserTypes());
        //$this->assertEquals(['nullable'***REMOVED***, $this->srcMvcMajorSuite->getConstraints());
        //$this->assertEquals([null***REMOVED***, $this->srcMvcMajorSuite->getTableAssocs());
    }
}
