<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;

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
            'Gear\Creator\FileCreator\FileCreator' => 'Gear\Creator\FileCreator\FileCreator',
            'GearBase\Util\String' => 'GearBase\Util\String\StringService',
            ModuleStructure::class => 'Gear\Module\Structure\ModuleStructure',
            'Gear\Module\Docs\Docs' => 'Gear\Module\Docs\Docs',
            'Gear\Module\Composer' => 'Gear\Module\ComposerService',
            'Gear\Module\Tests' => 'Gear\Module\Tests\ModuleTestsService',
            'Gear\Module\Node\Karma' => 'Gear\Module\Node\Karma',
            'Gear\Module\Node\Protractor' => 'Gear\Module\Node\Protractor',
            'Gear\Module\Node\Package' => 'Gear\Module\Node\Package',
            'Gear\Module\Node\Gulpfile' => 'Gear\Module\Node\Gulpfile',
            'Gear\Mvc\LanguageService' => 'Gear\Mvc\LanguageService',
            'GearJson\Schema' => 'GearJson\Schema',
            'GearJson\Schema\Loader'   => 'GearJson\Schema\Loader\SchemaLoaderService',
            'GearJson\Schema'          => 'GearJson\Schema\SchemaService',
            'Gear\Mvc\Config\ConfigService' => 'Gear\Mvc\Config\ConfigService',
            'Gear\Mvc\View\ViewService' => 'Gear\Mvc\View\ViewService',
            'Request' => 'Zend\Console\Request',
            'cacheService' => 'Gear\Cache\CacheService',
            'Gear\Autoload\ComposerAutoload' => 'Gear\Autoload\ComposerAutoload',
            'Gear\Module\Config\ApplicationConfig' => 'Gear\Module\Config\ApplicationConfig',
            'GearBase\Util\Dir' => 'GearBase\Util\Dir\DirService',
            'GearBase\GearConfig' => 'GearBase\Config\GearConfig',
            'Gear\Module\Constructor\Controller' => 'Gear\Constructor\Controller\ControllerConstructor',
            'Gear\Module\Constructor\Action' => 'Gear\Constructor\Action\ActionConstructor'
        ***REMOVED***;

        $this->serviceLocator->get('config')->willReturn([***REMOVED***)->shouldBeCalled();

        foreach ($expected as $callable => $object) {
            $this->serviceLocator->get($callable)->willReturn($this->prophesize($object)->reveal())->shouldBeCalled();
        }

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\ModuleService', $instance);
    }
}
