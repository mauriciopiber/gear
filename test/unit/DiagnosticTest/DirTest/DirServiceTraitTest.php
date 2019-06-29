<?php
namespace GearTest\DiagnosticTest\DirTest;

use PHPUnit\Framework\TestCase;
use Gear\Diagnostic\Dir\DirService;
use Gear\Diagnostic\Dir\DirServiceTrait;

/**
 * @group Gear
 * @group Diagnostic
 * @group DirService
 */
class DirServiceTraitTest extends TestCase
{
    use DirServiceTrait;

    public function testSet()
    {
        $mocking = $this->prophesize(DirService::class)->reveal();
        $this->setDirDiagnosticService($mocking);
        $this->assertEquals($mocking, $this->getDirDiagnosticService());
    }
}
