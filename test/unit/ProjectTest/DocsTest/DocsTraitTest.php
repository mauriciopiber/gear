<?php
namespace GearTest\ProjectTest\DocsTest;

use PHPUnit\Framework\TestCase;
use Gear\Project\Docs\DocsTrait;

/**
 * @group Gear
 * @group Docs
 */
class DocsTraitTest extends TestCase
{
    use DocsTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Project\Docs\Docs')->reveal();
        $this->setDocs($mocking);
        $this->assertEquals($mocking, $this->getDocs());
    }
}
