<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcSuiteTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuiteTrait;

/**
 * @group Gear
 * @group SrcSuite
 * @group Service
 */
class SrcSuiteTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use SrcSuiteTrait;

    public function setUp() : void
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\Src\SrcSuite\SrcSuite');
        $serviceManager->setService('Gear\Integration\Suite\Src\SrcSuite\SrcSuite', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getSrcSuite();
        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcSuite\SrcSuite', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Src\SrcSuite\SrcSuite')->reveal();
        $this->setSrcSuite($mocking);
        $this->assertEquals($mocking, $this->getSrcSuite());
    }
}
