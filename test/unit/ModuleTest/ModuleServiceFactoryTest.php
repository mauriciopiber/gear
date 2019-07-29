<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\ModuleServiceFactory;
use Interop\Container\ContainerInterface;
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
        $this->container    = $this->prophesize(ContainerInterface::class);

        $factory = new ModuleServiceFactory();

        $expected = [
            'Gear\Creator\FileCreator\FileCreator' => 'Gear\Creator\FileCreator\FileCreator',
            'Gear\Util\String\StringService' => 'Gear\Util\String\StringService',
            ModuleStructure::class => 'Gear\Module\Structure\ModuleStructure',
            'Gear\Module\Docs\Docs' => 'Gear\Module\Docs\Docs',
            'Gear\Module\Composer' => 'Gear\Module\ComposerService',
            'Gear\Module\Tests\ModuleTestsService' => 'Gear\Module\Tests\ModuleTestsService',
            'Gear\Module\Node\Package' => 'Gear\Module\Node\Package',
            'Gear\Mvc\LanguageService' => 'Gear\Mvc\LanguageService',
            'Gear\Schema\Schema\Loader\SchemaLoaderService'   => 'Gear\Schema\Schema\Loader\SchemaLoaderService',
            'Gear\Schema\Schema\SchemaService' => 'Gear\Schema\Schema\SchemaService',
            'Gear\Mvc\Config\ConfigService' => 'Gear\Mvc\Config\ConfigService',
            'Gear\Mvc\View\ViewService' => 'Gear\Mvc\View\ViewService',
            'Request' => 'Zend\Console\Request',
            'Gear\Autoload\ComposerAutoload' => 'Gear\Autoload\ComposerAutoload',
            'Gear\Util\Dir\DirService' => 'Gear\Util\Dir\DirService',
            'Gear\Config\GearConfig' => 'Gear\Config\GearConfig',
            'Gear\Constructor\Controller\ControllerConstructor' => 'Gear\Constructor\Controller\ControllerConstructor',
            'Gear\Constructor\Action\ActionConstructor' => 'Gear\Constructor\Action\ActionConstructor',
            'Gear\Docker\DockerService' => 'Gear\Docker\DockerService',
            'Gear\Kube\KubeService' => 'Gear\Kube\KubeService'
        ***REMOVED***;

        $this->container->get('config')->willReturn([***REMOVED***)->shouldBeCalled();

        foreach ($expected as $callable => $object) {
            $this->container->get($callable)->willReturn($this->prophesize($object)->reveal())->shouldBeCalled();
        }

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Module\ModuleService', $instance);
    }
}
