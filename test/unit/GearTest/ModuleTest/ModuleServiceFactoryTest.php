<?php
namespace GearTest\ModuleTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group Module
 * @group ModuleUpgrade
 * @group Upgrade
 */
class ModuleServiceFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Module\ModuleServiceFactory();


        $expected = [
            'Gear\FileCreator' => 'Gear\Creator\File',
            'GearBase\Util\String' => 'GearBase\Util\String\StringService',
            'moduleStructure' => 'Gear\Module\BasicModuleStructure',
            'Gear\Module\Docs\Docs' => 'Gear\Module\Docs\Docs',
            'Gear\Module\Composer' => 'Gear\Module\ComposerService',
            'Gear\Module\Codeception' => 'Gear\Module\CodeceptionService',
            'Gear\Module\Test' => 'Gear\Module\TestService',
            'Gear\Module\Node\Karma' => 'Gear\Module\Node\Karma',
            'Gear\Module\Node\Protractor' => 'Gear\Module\Node\Protractor',
            'Gear\Module\Node\Package' => 'Gear\Module\Node\Package',
            'Gear\Module\Node\Gulpfile' => 'Gear\Module\Node\Gulpfile',
            'Gear\Mvc\LanguageService' => 'Gear\Mvc\LanguageService',
            'GearJson\Schema' => 'GearJson\Schema',
            'GearJson\Schema\Loader'   => 'GearJson\Schema\Loader\SchemaLoaderService',
            'GearJson\Schema'          => 'GearJson\Schema\SchemaService',
            'GearJson\Action'          => 'GearJson\Action\ActionService',
            'GearJson\Controller'      => 'GearJson\Controller\ControllerService',
            'Gear\Mvc\Config\ConfigService' => 'Gear\Mvc\Config\ConfigService',
            'Gear\Mvc\Controller\Controller' => 'Gear\Mvc\Controller\ControllerService',
            'Gear\Mvc\Controller\ControllerTest' => 'Gear\Mvc\Controller\ControllerTestService',
            'Gear\Mvc\ConsoleController\ConsoleControllerTest' => 'Gear\Mvc\ConsoleController\ConsoleControllerTest',
            'Gear\Mvc\ConsoleController\ConsoleController' => 'Gear\Mvc\ConsoleController\ConsoleController',
            'Gear\Mvc\View\AngularService' => 'Gear\Mvc\View\AngularService',
            'Gear\Mvc\Spec\Feature\Feature' => 'Gear\Mvc\Spec\Feature\Feature',
            'Gear\Mvc\Spec\Step\Step' => 'Gear\Mvc\Spec\Step\Step',
            'Gear\Mvc\Spec\Page\Page' => 'Gear\Mvc\Spec\Page\Page',
            'Gear\Mvc\Spec\UnitTest\UnitTest' => 'Gear\Mvc\Spec\UnitTest\UnitTest',
            'Gear\Mvc\View\ViewService' => 'Gear\Mvc\View\ViewService'
        ***REMOVED***;

        foreach ($expected as $callable => $object) {
            $this->serviceLocator->get($callable)->willReturn($this->prophesize($object)->reveal())->shouldBeCalled();
        }



        /**

        $this->composer->reveal(),
        $this->codeception->reveal(),
        $this->testService->reveal(),
        $this->karma->reveal(),
        $this->protractor->reveal(),
        $this->package->reveal(),
        $this->gulpfile->reveal(),
        $this->languageService->reveal(),
        $this->schema->reveal(),
        $this->schemaLoader->reveal(),
        $this->schemaController->reveal(),
        $this->schemaAction->reveal()
        */

        //$console = $this->prophesize('Zend\Console\Adapter\Posix');

        //$this->serviceLocator->get('console')->willReturn($console->reveal())->shouldBeCalled();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\ModuleService', $instance);
    }
}