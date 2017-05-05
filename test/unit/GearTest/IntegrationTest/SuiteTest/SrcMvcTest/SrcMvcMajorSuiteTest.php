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

    }

    public function testClassExists()
    {
        $this->srcMvcMajorSuite = new SrcMvcMajorSuite(null, ['basic'***REMOVED***, ['all'***REMOVED***, ['nullable'***REMOVED***, [null***REMOVED***);

        $this->assertEquals(null, $this->srcMvcMajorSuite->getSuperType());
        $this->assertEquals(['basic'***REMOVED***, $this->srcMvcMajorSuite->getColumns());
        $this->assertEquals(['all'***REMOVED***, $this->srcMvcMajorSuite->getUserTypes());
        $this->assertEquals(['nullable'***REMOVED***, $this->srcMvcMajorSuite->getConstraints());
        $this->assertEquals([null***REMOVED***, $this->srcMvcMajorSuite->getTableAssocs());
    }
}
