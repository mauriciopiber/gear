<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group Service
 */
class MvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testMvcMinorSuite()
    {

        $this->mvcMinorSuite = new MvcMinorSuite(new MvcMajorSuite('mvc-complete'), null, null, null, null);
        $this->mvcMinorSuite->setTableName('mvc-complete-unique-not-null');

        $this->assertEquals('mvc-complete-unique-not-null', $this->mvcMinorSuite->getSuiteName());
    }
}
