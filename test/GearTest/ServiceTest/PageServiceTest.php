<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

class PageServiceTest extends AbstractGearTest
{
    public function testCanCallByServiceLocator()
    {
        $pageService = $this->getServiceLocator()->get('pageService');
        $this->assertInstanceOf('Gear\Service\PageService', $pageService);
    }
}
