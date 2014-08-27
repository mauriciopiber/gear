<?php
namespace GearTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include '/var/www/html/gear/config/application.config.php'
        );

        parent::setUp();
    }

    /* public function testCreateModule()
    {
        $this->dispatch('/gear/module');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear');
        $this->assertActionName('module');

    } */

    public function testCreateNewProjectAction() {

        $this->dispatch('/gear/create-new-project');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear');
        $this->assertActionName('create-new-project');
    }

    public function testCreateNewModuleInExistingProjectAction() {
        $this->dispatch('/gear/create-new-module-in-existing-project');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear');
        $this->assertActionName('create-new-module-in-existing-project');
    }

    public function testCreateNewModuleInNewProjectAction() {
        $this->dispatch('/gear/create-new-module-in-new-project');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear');
        $this->assertActionName('create-new-module-in-new-project');

    }

    public function testYML()
    {
        $this->dispatch('/gear/from-yml');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear');
        $this->assertActionName('from-yml');

        //$codeGear = new ModuleGear();
        //$codeGear->clearModule($module_name);
    }

    public function testDB()
    {
        $this->dispatch('/gear/from-db');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear');
        $this->assertActionName('from-db');
    }
}