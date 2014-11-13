<?php
namespace Gear\ServiceTest\ModuleTest;

use GearTest\AbstractGearTest;

class ComposerServiceTest extends AbstractGearTest
{

    /**
     * @group composer-up
/*
    public function testGearGetModuleDependencies()
    {

        $composerService = $this->getServiceLocator()->get('composerService');

        $dependencies = $composerService->getModuleDependencies();

        $this->assertInternalType('array', $dependencies);
        $this->assertInternalType('array', $dependencies['required'***REMOVED***);
        $this->assertInternalType('array', $dependencies['required-dev'***REMOVED***);

        $this->assertTrue(true);
    } */

    /**
     * @group composer-up
     */
    public function testGetModuleComposer()
    {
        /* @var $composerService \Gear\Service\Module\ComposerService */
        $composerService = $this->getServiceLocator()->get('composerService');

        $dependencies = $composerService->getModuleComposerJson('Gear');
        $this->assertInternalType('array', $dependencies);
        $this->assertEquals($dependencies['name'***REMOVED***, 'mauriciopiber/gear');
        $this->assertInternalType('array', $dependencies['require'***REMOVED***);
        $this->assertInternalType('array', $dependencies['require-dev'***REMOVED***);
    }

    public function testGetModuleRequireByComposer()
    {
        /* @var $composerService \Gear\Service\Module\ComposerService */
        $composerService = $this->getServiceLocator()->get('composerService');

        //$dependencies = $composerService->getModuleRequireByComposer('Gear');



    }

}
