<?php
namespace GearTest\ProjectTest\DocsTest;

use GearBaseTest\AbstractTestCase;
use Gear\Project\Docs\DocsTrait;

/**
 * @group Gear
 * @group Docs
 */
class DocsTraitTest extends AbstractTestCase
{
    use DocsTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Project\Docs\Docs')->reveal();
        $this->setDocs($mocking);
        $this->assertEquals($mocking, $this->getDocs());
    }
}
