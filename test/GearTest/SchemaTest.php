<?php
namespace GearTest;

use \GearTest\AbstractGearTest;

class SchemaTest extends AbstractGearTest
{
    protected $schema;

    public function setUp()
    {
        parent::setUp();
        $this->schema = $this->getServiceLocator()->get('Gear\Schema');
        $this->setTempMock(__DIR__.'/_mockfiles');
        $this->schema->setConfig($this->getMockConfig());
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testSchemaCreatedSuccesfull()
    {
        $this->assertInstanceOf('Gear\Schema', $this->schema);
        $this->assertInstanceOf('Gear\ValueObject\Config\Config', $this->schema->getConfig());
        $this->assertEquals('ModuleTest', $this->schema->getConfig()->getModule());
    }

    public function testInit()
    {
        $this->assertEquals(
            array($this->getModuleMock() => array('db' => array(), 'src' => array(), 'controller' => array())),
            $this->schema->init()
        );
    }

    public function insertDb()
    {

    }


    public function testGetControllerByName()
    {
        $this->schema->setName('getController.json');
        $controller = $this->schema->getControllerByName('MoveisController');

        $this->assertInstanceof('Gear\ValueObject\Controller', $controller);
        $this->assertEquals('MoveisController', $controller->getName());

    }

    public function testGetControllerByNameNotFound()
    {
        $this->schema->setName('getController.json');
        $controller = $this->schema->getControllerByName('MoveisControlle');
        $this->assertNull($controller);
    }
/*
    public function testSimulateCreatingNewModule()
    {
        $controller = array(
        	'name' => 'Index',
            'object' => 'Index',
            'service' => 'invokables'
        );

        $controller = new \Gear\ValueObject\Controller($controller);

        $controller = $controller->filter();

        $this->assertEquals('Index', $controller->getName());


        $controller = array(
            'name' => 'index-para-controller',
            'object' => 'Index',
            'service' => 'invokables'
        );

        $controller = new \Gear\ValueObject\Controller($controller);

        $controller = $controller->filter();

        $this->assertEquals('IndexParaController', $controller->getName());
    } */

    public function testGetJson()
    {

    }

    public function testEncodeJson()
    {

    }

    public function testDecodeJson()
    {

    }

    public function testInsertNewController()
    {

    }

    public function testFindControllerByName()
    {

    }

    public function testFindControllerByService()
    {

    }

    public function testFindControllerByObject()
    {

    }

    public function testFindActionByActionName()
    {

    }

    public function testFindActionByRoute()
    {

    }

    public function testFindActionByRole()
    {

    }

    public function testFindActionByControllerName()
    {

    }

    public function testUpdateController()
    {

    }

    public function testDeleteController()
    {

    }

    public function testInsertAction()
    {

    }

    public function testUpdateAction()
    {

    }

    public function testDeleteAction()
    {

    }

    public function testInsertSrc()
    {

    }

    public function testUpdateSrc()
    {

    }

    public function testDeleteSrc()
    {

    }

    public function testInsertDb()
    {

    }

    public function testUpdateDb()
    {

    }

    public function testDeleteDb()
    {

    }
}
