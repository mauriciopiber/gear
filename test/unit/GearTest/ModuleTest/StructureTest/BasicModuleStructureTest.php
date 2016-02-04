<?php
namespace GearTest\ModuleTest\StructureTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Module
 * @group Module-Structure
 */
class BasicModuleStructureTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->module = vfsStream::setup('moduleDir');
    }

    public function testPrepare()
    {
        /**
         * @TODO Mudar classe.
         */
        $basicModuleStructure = new \Gear\ValueObject\BasicModuleStructure();

        $basicModuleStructure->setMainFolder(vfsStream::url('moduleDir'));
        $basicModuleStructure->setModuleName('GearTest');

        $dir = new \Gear\Service\Filesystem\DirService;
        $basicModuleStructure->setDirService($dir);

        $str = new \Gear\Service\Type\StringService();
        $basicModuleStructure->setStringService($str);

        $basicModuleStructure->prepare();

        $this->assertEquals('vfs://moduleDir/config', $basicModuleStructure->getConfigFolder());
        $this->assertEquals('vfs://moduleDir/public', $basicModuleStructure->getPublicFolder());
        $this->assertEquals('vfs://moduleDir/src', $basicModuleStructure->getSrcFolder());


        $basicModuleStructure->write();

        $this->assertTrue(is_dir($basicModuleStructure->getPublicFolder()));
        $this->assertFalse(is_dir('vfs://moduleDir/configure'));
    }
}