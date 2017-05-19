<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group MinorSuite
 * @group Suite
 */
class MvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testMvcMinorSuite()
    {
        $this->major = new MvcMajorSuite('mvc-complete');

        $this->mvcMinorSuite = new MvcMinorSuite($this->major, null, null, null, null, true);
        $this->assertEquals($this->major, $this->mvcMinorSuite->getMajorSuite());
        $this->assertEquals(null, $this->mvcMinorSuite->getLocationKey());
        $this->assertTrue($this->mvcMinorSuite->isUsingLongName());
        //$this->mvcMinorSuite->setTableName('mvc-complete-unique-not-null');

        //$this->assertEquals('mvc-complete-unique-not-null', $this->mvcMinorSuite->getSuiteName());
    }
}
