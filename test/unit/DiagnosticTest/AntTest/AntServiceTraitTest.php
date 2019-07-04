<?php
namespace GearTest\DiagnosticTest\AntTest;

use PHPUnit\Framework\TestCase;
use Gear\Diagnostic\Ant\AntService;
use Gear\Diagnostic\Ant\AntServiceTrait;

/**
 * @group Gear
 * @group Diagnostic
 * @group AntService
 */
class AntServiceTraitTest extends TestCase
{
    use AntServiceTrait;

    public function testSet()
    {
        $mocking = $this->prophesize(AntService::class)->reveal();
        $this->setAntService($mocking);
        $this->assertEquals($mocking, $this->getAntService());
    }
}
