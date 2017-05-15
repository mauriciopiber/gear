<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group Service
 */
class MvcMajorSuiteTest extends TestCase
{
    public function testMvcMajorSuite()
    {
        $this->mvcMajorSuite = new MvcMajorSuite('mvc-complete');
        $this->assertEquals('mvc', $this->mvcMajorSuite->getSuite());
        $this->assertEquals('mvc-complete', $this->mvcMajorSuite->getSuperType());
    }
}
