<?php
namespace GearTest\IntegrationTest\ComponentTest\SuperTestFileTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;

/**
 * @group Gear
 * @group SuperTestFile
 * @group Service
 */
class SuperTestFileTraitTest extends TestCase
{

    use SuperTestFileTrait;

    public function testGet()
    {
        $serviceLocator = $this->getSuperTestFile();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal();
        $this->setSuperTestFile($mocking);
        $this->assertEquals($mocking, $this->getSuperTestFile());
    }
}
