<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;
use Gear\Diagnostic\Ant\{
    AntService
};
use Gear\Diagnostic\Composer\{
    ComposerService
};
use Gear\Diagnostic\File\{
    FileService
};
use Gear\Diagnostic\Dir\{
    DirService
};
use Gear\Diagnostic\Npm\{
    NpmService
};
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Module
 * @group Diagnostic
 * @group Dig
 * @group ModuleConstruct
 */
class DiagnosticServiceFactoryTest extends TestCase
{
    public function testCreateDiagnostic()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->serviceLocator->get('console')->willReturn($console);
        $this->serviceLocator->get(ModuleStructure::class)->willReturn($module);
        $this->serviceLocator->get(AntService::class)->willReturn($this->prophesize(AntService::class)->reveal());
        $this->serviceLocator->get(ComposerService::class)->willReturn($this->prophesize(ComposerService::class)->reveal());
        $this->serviceLocator->get(FileService::class)->willReturn($this->prophesize(FileService::class)->reveal());
        $this->serviceLocator->get(DirService::class)->willReturn($this->prophesize(DirService::class)->reveal());
        $this->serviceLocator->get(NpmService::class)->willReturn($this->prophesize(NpmService::class)->reveal());

        $factory = new \Gear\Module\Diagnostic\DiagnosticServiceFactory();

        $diagnostic = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\Diagnostic\DiagnosticService', $diagnostic);
    }
}
