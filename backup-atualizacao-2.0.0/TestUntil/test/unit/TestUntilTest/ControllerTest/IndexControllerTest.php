<?php
namespace TestUntilTest\ControllerTest;


use TestUntilTest\ControllerTest\AbstractControllerTest;

class IndexControllerTest extends AbstractControllerTest
{
    public function testCanAccessNewCreatedModule()
    {
        $this->dispatch('/test-until');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Index');
        $this->assertActionName('index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('test-until');
    }
}
