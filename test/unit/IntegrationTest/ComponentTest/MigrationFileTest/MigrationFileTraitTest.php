<?php
namespace GearTest\IntegrationTest\ComponentTest\MigrationFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\MigrationFile\MigrationFile;
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
        $mocking = $this->prophesize(MigrationFile::class)->reveal();
        $this->setMigrationFile($mocking);
        $this->assertEquals($mocking, $this->getMigrationFile());
    }
}
