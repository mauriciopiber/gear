<?php
namespace GearTest\IntegrationTest\ComponentTest\MigrationFileTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Component\MigrationFile\MigrationFileTrait;

/**
 * @group Gear
 * @group MigrationFile
 * @group Service
 */
class MigrationFileTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use MigrationFileTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Component\MigrationFile\MigrationFile');
        $serviceManager->setService('Gear\Integration\Component\MigrationFile\MigrationFile', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getMigrationFile();
        $this->assertInstanceOf('Gear\Integration\Component\MigrationFile\MigrationFile', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Component\MigrationFile\MigrationFile')->reveal();
        $this->setMigrationFile($mocking);
        $this->assertEquals($mocking, $this->getMigrationFile());
    }
}
