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

    /**
     * @group duplicate
     */

    public function testCheckDuplicateDb()
    {
        $this->schema->setName('admin.module.json');

        $mockDb = $this->getMockBuilder('Gear\ValueObject\Db')->disableOriginalConstructor()->getMock();

        $mockDb->expects($this->any())
        ->method('getTable')
        ->willReturn('Produto');

        $columnsToAdd = array('destaque' => 'simple-checkbox', 'adicionar' => 'simple-test');

        $mockDb->expects($this->any())
        ->method('getColumns')
        ->willReturn($columnsToAdd);

        $mockDb->expects($this->any())
        ->method('export')
        ->willReturn(array('table' => $mockDb->getTable(), 'columns' => $mockDb->getColumns()));


        $dbInsert = $this->schema->insertDb($mockDb);

        $this->assertTrue($dbInsert);

        $dbUpdated = $this->schema->getDbByName('Produto');

        $this->assertEquals($columnsToAdd, $dbUpdated->getColumns());
    }




    /**
     * @group duplicate
     */
    public function testGetReplaceLocationForSrc()
    {
        $this->schema->setName('admin.module.json');

        $location = $this->schema->getReplaceLocation('src', 'ProdutoRepository');

        $this->assertEquals($location, 1);

        $location = $this->schema->getReplaceLocation('src', 'CategoriaForm');

        $this->assertEquals($location, 9);

        $location = $this->schema->getReplaceLocation('src', 'InformacaoPrincipalService');

        $this->assertEquals($location, 14);

        $location = $this->schema->getReplaceLocation('src', 'InformacaoSobreFilter');

        $this->assertEquals($location, 22);

    }

    /**
     * @group duplicate
     */
    public function testGetReplaceLocationForController()
    {
        $this->schema->setName('admin.module.json');

        $location = $this->schema->getReplaceLocation('controller', 'IndexController');
        $this->assertEquals($location, 0);

        $location = $this->schema->getReplaceLocation('controller', 'ProdutoController');
        $this->assertEquals($location, 1);

        $location = $this->schema->getReplaceLocation('controller', 'CategoriaController');
        $this->assertEquals($location, 2);

        $location = $this->schema->getReplaceLocation('controller', 'InformacaoPrincipalController');
        $this->assertEquals($location, 3);

        $location = $this->schema->getReplaceLocation('controller', 'InformacaoSobreController');
        $this->assertEquals($location, 4);

        $location = $this->schema->getReplaceLocation('controller', 'FornecedorController');
        $this->assertEquals($location, 5);


    }

    /**
     * @group duplicate
     */
    public function testGetReplaceLocationForDb()
    {
        $this->schema->setName('admin.module.json');

        $location = $this->schema->getReplaceLocation('db', 'Produto');
        $this->assertEquals($location, 0);

        $location = $this->schema->getReplaceLocation('db', 'Categoria');
        $this->assertEquals($location, 1);

        $location = $this->schema->getReplaceLocation('db', 'InformacaoPrincipal');
        $this->assertEquals($location, 2);

        $location = $this->schema->getReplaceLocation('db', 'InformacaoSobre');
        $this->assertEquals($location, 3);

        $location = $this->schema->getReplaceLocation('db', 'Fornecedor');
        $this->assertEquals($location, 4);
    }

    /**
     * @group duplicate
     */
    public function testSelectDbFromSchemaAdmin()
    {
        $this->schema->setName('admin.module.json');

        $dbs = $this->schema->__extractObject('db');

        $this->assertEquals(5, count($dbs));
    }

    /**
     * @group duplicate
     */
    public function testSelectSrcFromSchemaAdmin()
    {
        $this->schema->setName('admin.module.json');

        $src = $this->schema->__extractObject('src');
        $this->assertEquals(30, count($src));
    }

    /**
     * @group duplicate
     */
    public function testSelectControllerFromSchemaAdmin()
    {
        $this->schema->setName('admin.module.json');

        $controller = $this->schema->__extractObject('controller');
        $this->assertEquals(6, count($controller));
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
