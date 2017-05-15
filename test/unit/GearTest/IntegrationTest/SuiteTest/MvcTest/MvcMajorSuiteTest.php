<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group MajorSuite
 * @group Suite
 */
class MvcMajorSuiteTest extends TestCase
{
    public function testMvcMajorSuite()
    {
        $this->mvcMajorSuite = new MvcMajorSuite('mvc-complete');
        $this->assertEquals('mvc', $this->mvcMajorSuite->getSuite());
        $this->assertEquals('mvc-complete', $this->mvcMajorSuite->getSuperType());
        $this->assertEquals('mvc/mvc-complete', $this->mvcMajorSuite->getLocationKey());
    }
}
