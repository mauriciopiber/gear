<?php
namespace GearTest\IntegrationTest\ComponentTest\TestFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\TestFile\TestFile;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Component\TestFile\TestFileTrait;

/**
 * @group Gear
 * @group TestFile
 * @group Service
 */
class TestFileTraitTest extends TestCase
{

    use TestFileTrait;

    public function testGet()
    {
        $serviceLocator = $this->getTestFile();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(TestFile::class)->reveal();
        $this->setTestFile($mocking);
        $this->assertEquals($mocking, $this->getTestFile());
    }
}
