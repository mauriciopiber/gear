<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuiteTrait;

/**
 * @group Gear
 * @group MvcSuite
 * @group Service
 */
class MvcSuiteTraitTest extends TestCase
{

    use MvcSuiteTrait;

    public function testGet()
    {
        $serviceLocator = $this->getMvcSuite();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite')->reveal();
        $this->setMvcSuite($mocking);
        $this->assertEquals($mocking, $this->getMvcSuite());
    }
}
