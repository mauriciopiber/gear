<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group Module
 * @group ModuleUpgrade
 * @group ModuleService
 * @group Upgrade
 */
class ModuleServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Module\ModuleServiceFactory();

        $expected = [
            'Gear\Mvc\Controller\Web\WebControllerService'     => 'Gear\Mvc\Controller\Web\WebControllerService',
            'Gear\Mvc\Controller\Web\WebControllerTestService' => 'Gear\Mvc\Controller\Web\WebControllerTestService',
            'Gear\Creator\FileCreator\FileCreator' => 'Gear\Creator\FileCreator\FileCreator',
            'GearBase\Util\String' => 'GearBase\Util\String\StringService',
            'moduleStructure' => 'Gear\Module\BasicModuleStructure',
            'Gear\Module\Docs\Docs' => 'Gear\Module\Docs\Docs',
            'Gear\Module\Composer' => 'Gear\Module\ComposerService',
            'Gear\Module\Codeception' => 'Gear\Module\CodeceptionService',
            'Gear\Module\Tests' => 'Gear\Module\Tests\ModuleTestsService',
            'Gear\Module\Node\Karma' => 'Gear\Module\Node\Karma',
            'Gear\Module\Node\Protractor' => 'Gear\Module\Node\Protractor',
            'Gear\Module\Node\Package' => 'Gear\Module\Node\Package',
            'Gear\Module\Node\Gulpfile' => 'Gear\Module\Node\Gulpfile',
            'Gear\Mvc\LanguageService' => 'Gear\Mvc\LanguageService',
            'GearJson\Schema' => 'GearJson\Schema',
            'GearJson\Schema\Loader'   => 'GearJson\Schema\Loader\SchemaLoaderService',
            'GearJson\Schema'          => 'GearJson\Schema\SchemaService',
            'GearJson\Action'          => 'GearJson\Action\ActionSchema',
            'GearJson\Controller'      => 'GearJson\Controller\ControllerSchema',
            'Gear\Mvc\Config\ConfigService' => 'Gear\Mvc\Config\ConfigService',
            'Gear\Mvc\Controller\Console\ConsoleControllerTestService' => 'Gear\Mvc\Controller\Console\ConsoleControllerTestService',
            'Gear\Mvc\Controller\Console\ConsoleControllerService' => 'Gear\Mvc\Controller\Console\ConsoleControllerService',
            'Gear\Mvc\View\App\AppControllerService' => 'Gear\Mvc\View\App\AppControllerService',
            'Gear\Mvc\View\App\AppControllerSpecService' => 'Gear\Mvc\View\App\AppControllerSpecService',
            'Gear\Mvc\Spec\Feature\Feature' => 'Gear\Mvc\Spec\Feature\Feature',
            'Gear\Mvc\Spec\Step\Step' => 'Gear\Mvc\Spec\Step\Step',
            'Gear\Mvc\Spec\Page\Page' => 'Gear\Mvc\Spec\Page\Page',
            'Gear\Mvc\Spec\UnitTest\UnitTest' => 'Gear\Mvc\Spec\UnitTest\UnitTest',
            'Gear\Mvc\View\ViewService' => 'Gear\Mvc\View\ViewService',
            'Request' => 'Zend\Console\Request',
            'cacheService' => 'Gear\Cache\CacheService',
            'Gear\Autoload\ComposerAutoload' => 'Gear\Autoload\ComposerAutoload',
            'Gear\Module\Config\ApplicationConfig' => 'Gear\Module\Config\ApplicationConfig',
            'GearBase\Util\Dir' => 'GearBase\Util\Dir\DirService',
            'GearBase\GearConfig' => 'GearBase\Config\GearConfig',
            'Gear\Module\Construct' => 'Gear\Module\ConstructService'
        ***REMOVED***;

        $this->serviceLocator->get('config')->willReturn([***REMOVED***)->shouldBeCalled();

        foreach ($expected as $callable => $object) {
            $this->serviceLocator->get($callable)->willReturn($this->prophesize($object)->reveal())->shouldBeCalled();
        }

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\ModuleService', $instance);
    }
}
