<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @group Module
 * @group Diagnostic
 * @group Dig
 * @group ModuleConstruct
 */
class DiagnosticServiceTraitTest extends TestCase
{
    use \Gear\Module\Diagnostic\DiagnosticServiceTrait;

    public function testSet()
    {
        $mockComposerUpgrade = $this->prophesize(
            'Gear\Module\Diagnostic\DiagnosticService'
        )->reveal();
        $this->setDiagnosticService($mockComposerUpgrade);
        $this->assertEquals($mockComposerUpgrade, $this->getDiagnosticService());
    }

}
