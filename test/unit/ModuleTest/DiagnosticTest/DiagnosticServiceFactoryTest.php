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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->container->get('console')->willReturn($console);
        $this->container->get(ModuleStructure::class)->willReturn($module);
        $this->container->get(AntService::class)->willReturn($this->prophesize(AntService::class)->reveal());
        $this->container->get(ComposerService::class)->willReturn($this->prophesize(ComposerService::class)->reveal());
        $this->container->get(FileService::class)->willReturn($this->prophesize(FileService::class)->reveal());
        $this->container->get(DirService::class)->willReturn($this->prophesize(DirService::class)->reveal());
        $this->container->get(NpmService::class)->willReturn($this->prophesize(NpmService::class)->reveal());

        $factory = new \Gear\Module\Diagnostic\DiagnosticServiceFactory();

        $diagnostic = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Module\Diagnostic\DiagnosticService', $diagnostic);
    }
}
