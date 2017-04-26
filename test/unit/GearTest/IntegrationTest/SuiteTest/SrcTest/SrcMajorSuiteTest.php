<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Src\SrcMajorSuite;

/**
 * @group Service
 */
class SrcMajorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->srcMajorSuite = new SrcMajorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcMajorSuite', $this->srcMajorSuite);
    }
}
