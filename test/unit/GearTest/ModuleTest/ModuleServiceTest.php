<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Module
 * @group ModuleServiceTest
 */
class ModuleServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->module = vfsStream::setup('moduleDir');
    }

    public function testCreateComposer()
    {

    }



    /*
    public function testCreateModuleAsProject()
    {
        $dirService = new \GearBase\Util\Dir\DirService();
        $strService = new \GearBase\Util\String\StringService();

        $basicModuleStructure = new \Gear\Module\BasicModuleStructure();
        $basicModuleStructure->setMainFolder(vfsStream::url('moduleDir'));
        $basicModuleStructure->setModuleName('GearTest');
        $basicModuleStructure->setDirService($dirService);
        $basicModuleStructure->setStringService($strService);
        $basicModuleStructure->prepare();



        $moduleName = 'GearTest';
        $basepath = vfsStream::url('moduleDir');


        $moduleService = new \Gear\Module\ModuleService();


        //$moduleService->moduleAsProject($basicModuleStructure, $moduleName, $basepath);

    }
    */
}