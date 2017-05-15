<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Controller\ControllerMajorSuite;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;

/**
 * @group MajorSuite
 */
class ControllerMajorSuiteTest extends TestCase
{
    public function testControllerMajorSuite()
    {
        $this->controllerMajorSuite = new ControllerMajorSuite();
        $this->assertEquals('controller', $this->controllerMajorSuite->getSuite());
        $this->assertEquals('controller', $this->controllerMajorSuite->getSuperType());
        $this->assertEquals('controller', $this->controllerMajorSuite->getLocationKey());
    }
}
