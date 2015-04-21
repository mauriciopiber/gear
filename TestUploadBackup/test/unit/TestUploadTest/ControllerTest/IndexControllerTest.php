<?php
namespace TestUploadTest\ControllerTest;

use TestUploadTest\ControllerTest\AbstractControllerTest;

/**
 * @group Controller
 */
class IndexControllerTest extends AbstractControllerTest
{
    public function testCanAccessNewCreatedModule()
    {
        $this->dispatch('/test-upload');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\Index');
        $this->assertActionName('index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('test-upload');
    }
}
