<?php
namespace GearTest\ConstructorTest\ViewTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\View\ViewServiceTrait;

/**
 * @group module
 */
class ViewServiceTest extends AbstractTestCase
{
    use ViewServiceTrait;

    public function testServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\View\ViewService', $this->getViewService());
    }
}
