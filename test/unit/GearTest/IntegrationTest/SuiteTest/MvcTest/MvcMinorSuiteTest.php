<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;

/**
 * @group Service
 */
class MvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->mvcMinorSuite = new MvcMinorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcMinorSuite', $this->mvcMinorSuite);
    }
}
