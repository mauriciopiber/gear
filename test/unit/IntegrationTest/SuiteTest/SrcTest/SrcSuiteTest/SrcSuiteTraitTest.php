<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcSuiteTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuiteTrait;

/**
 * @group Gear
 * @group SrcSuite
 * @group Service
 */
class SrcSuiteTraitTest extends TestCase
{

    use SrcSuiteTrait;

    public function testGet()
    {
        $serviceLocator = $this->getSrcSuite();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Src\SrcSuite\SrcSuite')->reveal();
        $this->setSrcSuite($mocking);
        $this->assertEquals($mocking, $this->getSrcSuite());
    }
}
