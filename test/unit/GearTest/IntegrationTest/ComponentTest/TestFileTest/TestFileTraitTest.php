<?php
namespace GearTest\IntegrationTest\ComponentTest\TestFileTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Component\TestFile\TestFileTrait;

/**
 * @group Gear
 * @group TestFile
 * @group Service
 */
class TestFileTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use TestFileTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Component\TestFile\TestFile');
        $serviceManager->setService('Gear\Integration\Component\TestFile\TestFile', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getTestFile();
        $this->assertInstanceOf('Gear\Integration\Component\TestFile\TestFile', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Component\TestFile\TestFile')->reveal();
        $this->setTestFile($mocking);
        $this->assertEquals($mocking, $this->getTestFile());
    }
}
