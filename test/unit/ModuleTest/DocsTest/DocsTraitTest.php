<?php
namespace GearTest\ModuleTest\DocsTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Docs\DocsTrait;

/**
 * @group Gear
 * @group Docs
 */
class DocsTraitTest extends TestCase
{
    use DocsTrait;
    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Module\Docs\Docs')->reveal();
        $this->setDocs($mocking);
        $this->assertEquals($mocking, $this->getDocs());
    }
}
