<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;

/**
 * @group MinorSuite
 */
class ControllerMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->controllerMinorSuite = new ControllerMinorSuite();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerMinorSuite', $this->controllerMinorSuite);
    }
}
