<?php
namespace GearTest\MvcTest\SpecTest\PageTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Spec\Page\PageTrait;

/**
 * @group Gear
 * @group Page
 */
class PageTraitTest extends TestCase
{
    use PageTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Spec\Page\Page')->reveal();
        $this->setPage($mocking);
        $this->assertEquals($mocking, $this->getPage());
    }
}
