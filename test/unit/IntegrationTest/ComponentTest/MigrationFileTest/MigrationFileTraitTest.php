<?php
namespace GearTest\IntegrationTest\ComponentTest\MigrationFileTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Component\MigrationFile\MigrationFileTrait;

/**
 * @group Gear
 * @group MigrationFile
 * @group Service
 */
class MigrationFileTraitTest extends TestCase
{

    use MigrationFileTrait;

    public function testGet()
    {
        $serviceLocator = $this->getMigrationFile();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Component\MigrationFile\MigrationFile')->reveal();
        $this->setMigrationFile($mocking);
        $this->assertEquals($mocking, $this->getMigrationFile());
    }
}
