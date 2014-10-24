<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class PageTest extends AbstractGearTest
{
    /**
     * @group rev2
     */
    public function testStdClassToPage()
    {
        $stdClass = new \stdClass();
        $stdClass->action = 'action';
        $stdClass->route = 'route';
        $stdClass->role = 'role';

        $page = new \Gear\ValueObject\Page($stdClass);

        $this->assertInstanceOf('Gear\ValueObject\Page', $page);

        $action = $page->getAction();
        $route = $page->getRoute();
        $role = $page->getRole();
        $controller = $page->getController();

        $this->assertEquals('action', $action);
        $this->assertEquals('route', $route);
        $this->assertEquals('role', $role);
        $this->assertEquals(null, $controller);
    }

    public function testCreateServiceFromArray()
    {
        $pageParam = array(
        	'action' => 'myAction',
            'route' => 'myRoute',
            'role' => 'myRole'
        );

        $page = new \Gear\ValueObject\Page($pageParam);

        $action = $page->getAction();
        $route = $page->getRoute();
        $role = $page->getRole();
        $controller = $page->getController();

        $this->assertEquals('myAction', $action);
        $this->assertEquals('myRoute', $route);
        $this->assertEquals('myRole', $role);
        $this->assertEquals(null, $controller);
    }
}
