<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerSrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;

/**
 * @group MajorSuite
 * @group Suite
 */
class ControllerMvcMajorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

    }

    public function testControllerMvcMajorSuite()
    {
        $this->controllerMvcMajorSuite = new ControllerMvcMajorSuite(['basic'***REMOVED***, ['all'***REMOVED***, ['nullable'***REMOVED***, [null***REMOVED***);
        $this->assertEquals('controller-mvc', $this->controllerMvcMajorSuite->getSuite());
        $this->assertEquals('controller-mvc', $this->controllerMvcMajorSuite->getSuperType());
        $this->assertEquals('controller-mvc', $this->controllerMvcMajorSuite->getLocationKey());

    }
}
