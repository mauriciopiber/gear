<?php
namespace GearTest\IntegrationTest\ComponentTest\GearFileTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Component\GearFile\GearFileTrait;

/**
 * @group Gear
 * @group GearFile
 * @group Service
 */
class GearFileTraitTest extends TestCase
{

    use GearFileTrait;

    public function testGet()
    {
        $serviceLocator = $this->getGearFile();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Component\GearFile\GearFile')->reveal();
        $this->setGearFile($mocking);
        $this->assertEquals($mocking, $this->getGearFile());
    }
}
