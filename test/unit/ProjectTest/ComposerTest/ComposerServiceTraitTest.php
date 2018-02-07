<?php
namespace GearTest\ProjectTest\ComposerTest;

use GearBaseTest\AbstractTestCase;
use Gear\Project\Composer\ComposerServiceTrait;

/**
 * @group Gear
 * @group ComposerService
 */
class ComposerServiceTraitTest extends AbstractTestCase
{
    use ComposerServiceTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Project\Composer\ComposerService')->reveal();
        $this->setComposerService($mocking);
        $this->assertEquals($mocking, $this->getComposerService());
    }
}
