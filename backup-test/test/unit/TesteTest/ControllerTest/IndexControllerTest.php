<?php
namespace TesteTest\ControllerTest;

use TesteTest\ControllerTest\AbstractControllerTest;

/**
 * @group Controller
 */
class IndexControllerTest extends AbstractControllerTest
{
    public function testCanAccessNewCreatedModule()
    {
        $this->dispatch('/teste');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Index');
        $this->assertActionName('index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('teste');
    }
}
