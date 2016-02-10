<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Module
 * @group ModuleTest
 */
class ModuleTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->module = vfsStream::setup('moduleDir');
    }

    public function testCreateModuleAsProject()
    {
        $dirService = new \GearBase\Util\Dir\DirService();
        $strService = new \GearBase\Util\String\StringService();

        /**
         * @TODO Mudar classe.
         */
        $basicModuleStructure = new \Gear\Module\BasicModuleStructure();
        $basicModuleStructure->setMainFolder(vfsStream::url('moduleDir'));
        $basicModuleStructure->setModuleName('GearTest');
        $basicModuleStructure->setDirService($dirService);
        $basicModuleStructure->setStringService($strService);
        $basicModuleStructure->prepare();



        $moduleName = 'GearTest';
        $basepath = vfsStream::url('moduleDir');


        /**
         * @TODO Mudar classe.
         */
        $moduleService = new \Gear\Module\ModuleService();

        /**
         * Dependências
         *
         * - Composer
         * - Controller
         * - ControllerTest
         * - Config
         */

        //$moduleService->moduleAsProject($basicModuleStructure, $moduleName, $basepath);


        //var_dump($moduleService);die();
        $this->assertTrue(true);


    }
}