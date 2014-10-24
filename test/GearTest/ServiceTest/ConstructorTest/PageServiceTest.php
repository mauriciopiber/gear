<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

class PageServiceTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getServiceLocator()->get('pageService');
        $this->module = $this->getServiceLocator()->get('moduleService');
        //$this->module->createEmptyModule('ModuleSandbox');
    }


    public function tearDown()
    {
        parent::tearDown();

        //$this->module->delete('ModuleSandbox');
    }

    public function testCreateStdClass()
    {
        $stdClass = $this->service->createStdClass();
        $this->assertInstanceOf('stdClass', $stdClass);
     //   $this->assertObjectHasAttribute('name', $stdClass);
     //   $this->assertObjectHasAttribute('invokable', $stdClass);
        //$this->assertObjectHasAttribute('invokable', $stdClass);
    }

    /**
     * @group page
     */

    public function testCanCallByServiceLocator()
    {
        $this->assertInstanceOf('Gear\Service\Constructor\PageService', $this->service);
    }
/*
    public function testPageAlreadyExist()
    {

        $pageMock = $this->getMockBuilder('Gear\ValueObject\Page')
        ->getMock();

        $pageMock->expects($this->any())
        ->method('getController')
        ->willreturn('IndexController');

        $pageMock->expects($this->any())
        ->method('getAction')
        ->willreturn('index');

        $pageMock->expects($this->any())
        ->method('getRoute')
        ->willreturn('index');

        $this->assertTrue($this->service->isPageAlreadyExist($pageMock));
    }

    public function testPageNotExist()
    {
        $pageMock = $this->getMockBuilder('Gear\ValueObject\Page')
        ->getMock();

        $pageMock->expects($this->any())
        ->method('getController')
        ->willreturn('IndexController');

        $pageMock->expects($this->any())
        ->method('getAction')
        ->willreturn('noExistingAction');

        $pageMock->expects($this->any())
        ->method('getRoute')
        ->willreturn('no-route');

        $this->assertFalse($this->service->isPageAlreadyExist($pageMock));
    } */
}
