<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;

/**
 * @group mvc-trait
 */
class TraitTestServiceTraitTest extends TestCase
{
    use \Gear\Mvc\TraitTestServiceTrait;

    public function testSet()
    {
        $mockComposerUpgrade = $this->prophesize(
            'Gear\Mvc\TraitTestService'
        )->reveal();
        $this->setTraitTestService($mockComposerUpgrade);
        $this->assertEquals($mockComposerUpgrade, $this->getTraitTestService());
    }

}
