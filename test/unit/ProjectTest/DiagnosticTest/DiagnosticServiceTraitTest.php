<?php
namespace GearTest\ProjectTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;
use Gear\Project\Diagnostic\DiagnosticServiceTrait;

/**
 * @group Diagnostic
 * @group Service
 */
class DiagnosticServiceTraitTest extends TestCase
{
    use DiagnosticServiceTrait;

    /**
     * @group Gear
     * @group DiagnosticService
    */
    public function testSet()
    {
        $mockDiagnostic = $this->prophesize(
            'Gear\Project\Diagnostic\DiagnosticService'
        );
        $this->setDiagnosticService($mockDiagnostic->reveal());
        $this->assertEquals($mockDiagnostic->reveal(), $this->getDiagnosticService());
    }
}
