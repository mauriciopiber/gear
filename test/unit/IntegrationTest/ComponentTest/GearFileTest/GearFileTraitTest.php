<?php
namespace GearTest\IntegrationTest\ComponentTest\GearFileTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Component\GearFile\GearFileTrait;

/**
 * @group Gear
 * @group GearFile
 * @group Service
 */
class GearFileTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use GearFileTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Component\GearFile\GearFile');
        $serviceManager->setService('Gear\Integration\Component\GearFile\GearFile', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getGearFile();
        $this->assertInstanceOf('Gear\Integration\Component\GearFile\GearFile', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Component\GearFile\GearFile')->reveal();
        $this->setGearFile($mocking);
        $this->assertEquals($mocking, $this->getGearFile());
    }
}
