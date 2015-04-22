<?php
namespace ColumnTest\ControllerTest;

use ColumnTest\ControllerTest\AbstractControllerTest;

/**
 * @group Controller
 */
class IndexControllerTest extends AbstractControllerTest
{
    public function testCanAccessNewCreatedModule()
    {
        $this->dispatch('/column');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Index');
        $this->assertActionName('index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('column');
    }
}
