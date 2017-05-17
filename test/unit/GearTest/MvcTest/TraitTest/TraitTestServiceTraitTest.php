<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group mvc-trait
 */
class TraitTestServiceTraitTest extends AbstractTestCase
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
