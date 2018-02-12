<?php
namespace GearTest\IntegrationTest\ComponentTest\SuperTestFileTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;

/**
 * @group Gear
 * @group SuperTestFile
 * @group Service
 */
class SuperTestFileTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use SuperTestFileTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile');
        $serviceManager->setService('Gear\Integration\Component\SuperTestFile\SuperTestFile', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getSuperTestFile();
        $this->assertInstanceOf('Gear\Integration\Component\SuperTestFile\SuperTestFile', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal();
        $this->setSuperTestFile($mocking);
        $this->assertEquals($mocking, $this->getSuperTestFile());
    }
}
