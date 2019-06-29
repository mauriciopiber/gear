<?php
namespace GearTest\DiagnosticTest\FileTest;

use PHPUnit\Framework\TestCase;
use Gear\Diagnostic\File\FileService;
use Gear\Diagnostic\File\FileServiceTrait;

/**
 * @group Gear
 * @group Diagnostic
 * @group FileService
 */
class FileServiceTraitTest extends TestCase
{
    use FileServiceTrait;

    public function testSet()
    {
        $mocking = $this->prophesize(FileService::class)->reveal();
        $this->setFileDiagnosticService($mocking);
        $this->assertEquals($mocking, $this->getFileDiagnosticService());
    }
}
