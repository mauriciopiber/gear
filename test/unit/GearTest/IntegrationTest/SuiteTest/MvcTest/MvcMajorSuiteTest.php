<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group Service
 */
class MvcMajorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->mvcMajorSuite = new MvcMajorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcMajorSuite', $this->mvcMajorSuite);
    }
}
