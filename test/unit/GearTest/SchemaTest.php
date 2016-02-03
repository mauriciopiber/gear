<?php
namespace GearTest;

use GearBaseTest\AbstractTestCase;

class SchemaTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $this->module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getMainFolder'));
        $this->module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $this->module->expects($this->any())->method('getMainFolder')->willReturn(__DIR__.'/_files');

        $this->schema = new \Gear\Schema($this->module, $this->getServiceLocator());
        $this->schemaJson = $this->schema->init();
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @group testController
     */
    public function testInsertController()
    {

        $controllerMock = $this->getMockSingleClass('Gear\ValueObject\Controller', array('export'));
        $controllerMock->expects($this->any())->method('export')->willReturn(array(
        	'name' => 'Internacional',
            'object' => '%s\Controller\Internacional'
        ));

        $this->schema->setName('/schema.json');
        $this->schema->persistSchema($this->schemaJson);

        $this->schema->insertController($this->schemaJson, $controllerMock->export());


        $expected = file_get_contents(__DIR__.'/_expected/schema-insert-controller.json');
        $actual = file_get_contents(__DIR__.'/_files/schema.json');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group testController
     */
    public function testInsertMultipleControllers()
    {

        $this->schema->setName('/schema.json');
        $this->schema->persistSchema($this->schemaJson);

        $controllerMock = $this->getMockSingleClass('Gear\ValueObject\Controller', array('export'));
        $controllerMock->expects($this->any())->method('export')->willReturn(array(
            'name' => 'Internacional',
            'object' => '%s\Controller\Internacional'
        ));

        $this->schema->addController($controllerMock->export());

        $controllerMock = $this->getMockSingleClass('Gear\ValueObject\Controller', array('export'));
        $controllerMock->expects($this->any())->method('export')->willReturn(array(
            'name' => 'Gremio',
            'object' => '%s\Controller\Gremio'
        ));

        $this->schema->addController($controllerMock->export());

        $controllerMock = $this->getMockSingleClass('Gear\ValueObject\Controller', array('export'));
        $controllerMock->expects($this->any())->method('export')->willReturn(array(
            'name' => 'Juventude',
            'object' => '%s\Controller\Juventude'
        ));

        $this->schema->addController($controllerMock->export());

        $expected = file_get_contents(__DIR__.'/_expected/schema-insert-multiple-controllers.json');
        $actual = file_get_contents(__DIR__.'/_files/schema.json');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group testAction
     */
    public function testInsertAction()
    {
        $this->schema->setName('/schema.json');
        $this->schema->persistSchema($this->schemaJson);

        $controllerMock = $this->getMockSingleClass('Gear\ValueObject\Controller', array('export'));
        $controllerMock->expects($this->any())->method('export')->willReturn(array(
            'name' => 'Internacional',
            'object' => '%s\Controller\Internacional',
            'actions' => array(
        	    array(
            	    'name' => 'MyAction',
        	        'route' => 'my-action',
        	        'role' => 'admin'
                )
            ),
        ));

        $this->schema->addController($controllerMock->export());


        $actionMock = $this->getMockSingleClass('Gear\ValueObject\Action', array('getName', 'getRoute', 'getRole', 'getController'));
        $actionMock->expects($this->any())->method('getName')->willReturn('MyAction');
        $actionMock->expects($this->any())->method('getRoute')->willReturn('my-action');
        $actionMock->expects($this->any())->method('getRole')->willReturn('admin');
        $actionMock->expects($this->any())->method('getController')->willReturn($controllerMock);

        $controllerMock->addAction($actionMock);

        $this->schema->overwrite($controllerMock);

        $expected = file_get_contents(__DIR__.'/_expected/schema-insert-action.json');
        $actual = file_get_contents(__DIR__.'/_files/schema.json');

        $this->assertEquals($expected, $actual);
    }


    /**
     * @group testAction
     */
    public function testInsertMultipleAction()
    {
        $this->schema->setName('/schema.json');
        $this->schema->persistSchema($this->schemaJson);

        $controllerMock = $this->getMockSingleClass('Gear\ValueObject\Controller', array('export'));
        $controllerMock->expects($this->any())->method('export')->willReturn(array(
            'name' => 'Internacional',
            'object' => '%s\Controller\Internacional',
            'actions' => array(
                array(
                    'name' => 'BiLibertadores',
                    'route' => 'bi-libertadores',
                    'role' => 'admin'
                ),
                array(
                    'name' => 'CampeaoMundial',
                    'route' => 'campeao-mundial',
                    'role' => 'admin'
                ),
                array(
                    'name' => 'TriBrasileiro',
                    'route' => 'tri-brasileiro',
                    'role' => 'admin'
                ),
            ),
        ));

        $this->schema->addController($controllerMock->export());

        $controllerMock = $this->getMockSingleClass('Gear\ValueObject\Controller', array('export'));
        $controllerMock->expects($this->any())->method('export')->willReturn(array(
            'name' => 'Gremio',
            'object' => '%s\Controller\Gremio',
            'actions' => array(
                array(
                    'name' => 'BiLibertadores',
                    'route' => 'bi-libertadores',
                    'role' => 'admin'
                ),
                array(
                    'name' => 'CampeaoMundial',
                    'route' => 'campeao-mundial',
                    'role' => 'admin'
                ),
                array(
                    'name' => 'TetraCopaDoBrasil',
                    'route' => 'tetra-copa-do-brasil',
                    'role' => 'admin'
                ),
            ),
        ));

        $this->schema->addController($controllerMock->export());

        $this->schema->overwrite($controllerMock);

        $expected = file_get_contents(__DIR__.'/_expected/schema-insert-multiple-action.json');
        $actual = file_get_contents(__DIR__.'/_files/schema.json');

        $this->assertEquals($expected, $actual);
    }


    public function testInitSchema()
    {
        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schemaInit = $schema->init();

        $this->assertArrayHasKey('SchemaModule', $schemaInit);
        $this->assertArrayHasKey('src', $schemaInit['SchemaModule'***REMOVED***);
        $this->assertArrayHasKey('controller', $schemaInit['SchemaModule'***REMOVED***);
        $this->assertArrayHasKey('db', $schemaInit['SchemaModule'***REMOVED***);
    }

    public function testPersistSchema()
    {
        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getMainFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getMainFolder')->willReturn(__DIR__.'/_files');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');

        $init = $schema->init();

        $schema->persistSchema($init);

        $this->assertFileExists(__DIR__.'/_files/schema.json');
    }

    public function testInsertSrc()
    {
        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getMainFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getMainFolder')->willReturn(__DIR__.'/_files');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('export'));
        $src->expects($this->any())->method('export')->willReturn(array(
        	'name' => 'PrimeiroTeste',
            'type' => null
        ));

        $init = $schema->init();

        $schema->persistSchema($init);

        $schema->insertSrc($src->export());

        $inserted = $schema->decode($schema->getJsonFromFile());

        $this->assertArrayHasKey('SchemaModule', $inserted);
        $this->assertArrayHasKey('src', $inserted['SchemaModule'***REMOVED***);

        $this->assertCount(1, $inserted['SchemaModule'***REMOVED***['src'***REMOVED***);

        $this->assertArrayHasKey('name', $inserted['SchemaModule'***REMOVED***['src'***REMOVED***[0***REMOVED***);
        $this->assertArrayHasKey('type', $inserted['SchemaModule'***REMOVED***['src'***REMOVED***[0***REMOVED***);

        $this->assertEquals('PrimeiroTeste', $inserted['SchemaModule'***REMOVED***['src'***REMOVED***[0***REMOVED***['name'***REMOVED***);
        $this->assertEquals(null, $inserted['SchemaModule'***REMOVED***['src'***REMOVED***[0***REMOVED***['type'***REMOVED***);
    }


    /*
    public function testMakeController()
    {
        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getMainFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getMainFolder')->willReturn(__DIR__.'/_files');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());

        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable'));
        $db->expects($this->any())->method('getTable')->willReturn('TableDb');

        $controller = $schema->makeController($db);

        $this->assertInstanceOf('Gear\ValueObject\Controller', $controller);

        $service = $controller->getService();
        $this->assertEquals('invokables', $service->getService());
        $this->assertEquals('%s\Controller\TableDb', $service->getObject());
        $this->assertEquals('TableDbController', $controller->getName());

        $this->assertCount(5, $controller->getActions());

        $actions = $controller->getActions();

    }
    */

    public function testInsertSrcWithoutType()
    {
        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getMainFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getMainFolder')->willReturn(__DIR__.'/_files');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('export'));
        $src->expects($this->any())->method('export')->willReturn(array(
            'name' => 'PrimeiroTeste',
            'type' => null,
            'namespace' => 'MyFolder\MyOtherFolder'
        ));

        $init = $schema->init();

        $schema->persistSchema($init);

        $schema->insertSrc($src->export());

        $actualSchema = $schema->getJsonFromFile();

        $inserted = $schema->decode($schema->getJsonFromFile());

        $insertedSrc = $inserted[$module->getModuleName()***REMOVED***['src'***REMOVED***[0***REMOVED***;

        $this->assertEquals('PrimeiroTeste', $insertedSrc['name'***REMOVED***);
        $this->assertEquals(null, $insertedSrc['type'***REMOVED***);
        $this->assertEquals('MyFolder\MyOtherFolder', $insertedSrc['namespace'***REMOVED***);

    }

    public function testMakeSrc()
    {
        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getMainFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getMainFolder')->willReturn(__DIR__.'/_files');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());

        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable'));
        $db->expects($this->any())->method('getTable')->willReturn('TableDb');


        $srcs = $schema->makeSrc($db);

        $this->assertCount(9, $srcs);


        $this->assertEquals('TableDb', $srcs[0***REMOVED***->getName());
        $this->assertEquals('Entity', $srcs[0***REMOVED***->getType());
        $this->assertEquals(null, $srcs[0***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[0***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[0***REMOVED***->getExtends());
        $this->assertEquals(array(), $srcs[0***REMOVED***->getDependency());


        $this->assertEquals('TableDbRepository', $srcs[1***REMOVED***->getName());
        $this->assertEquals('Repository', $srcs[1***REMOVED***->getType());
        $this->assertEquals(null, $srcs[1***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[1***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[1***REMOVED***->getExtends());
        $this->assertEquals(array(), $srcs[1***REMOVED***->getDependency());

        $this->assertEquals('TableDbService', $srcs[2***REMOVED***->getName());
        $this->assertEquals('Service', $srcs[2***REMOVED***->getType());
        $this->assertEquals(null, $srcs[2***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[2***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[2***REMOVED***->getExtends());
        $this->assertEquals(array('Repository\TableDb'), $srcs[2***REMOVED***->getDependency());


        $this->assertEquals('TableDbForm', $srcs[3***REMOVED***->getName());
        $this->assertEquals('Form', $srcs[3***REMOVED***->getType());
        $this->assertEquals(null, $srcs[3***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[3***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[3***REMOVED***->getExtends());
        $this->assertEquals(array(), $srcs[3***REMOVED***->getDependency());


        $this->assertEquals('TableDbFilter', $srcs[4***REMOVED***->getName());
        $this->assertEquals('Filter', $srcs[4***REMOVED***->getType());
        $this->assertEquals(null, $srcs[4***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[4***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[4***REMOVED***->getExtends());
        $this->assertEquals(array(), $srcs[4***REMOVED***->getDependency());

        $this->assertEquals('TableDbFixture', $srcs[5***REMOVED***->getName());
        $this->assertEquals('Fixture', $srcs[5***REMOVED***->getType());
        $this->assertEquals(null, $srcs[5***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[5***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[5***REMOVED***->getExtends());
        $this->assertEquals(array(), $srcs[5***REMOVED***->getDependency());

        $this->assertEquals('TableDbFactory', $srcs[6***REMOVED***->getName());
        $this->assertEquals('Factory', $srcs[6***REMOVED***->getType());
        $this->assertEquals(null, $srcs[6***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[6***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[6***REMOVED***->getExtends());
        $this->assertEquals(array('Filter\TableDb', 'Form\TableDb'), $srcs[6***REMOVED***->getDependency());

        $this->assertEquals('TableDbFactory', $srcs[6***REMOVED***->getName());
        $this->assertEquals('Factory', $srcs[6***REMOVED***->getType());
        $this->assertEquals(null, $srcs[6***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[6***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[6***REMOVED***->getExtends());
        $this->assertEquals(array('Filter\TableDb', 'Form\TableDb'), $srcs[6***REMOVED***->getDependency());

        $this->assertEquals('TableDbSearchFactory', $srcs[7***REMOVED***->getName());
        $this->assertEquals('SearchFactory', $srcs[7***REMOVED***->getType());
        $this->assertEquals(null, $srcs[7***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[7***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[7***REMOVED***->getExtends());
        $this->assertEquals(array(), $srcs[7***REMOVED***->getDependency());

        $this->assertEquals('TableDbSearchForm', $srcs[8***REMOVED***->getName());
        $this->assertEquals('SearchForm', $srcs[8***REMOVED***->getType());
        $this->assertEquals(null, $srcs[8***REMOVED***->getAbstract());
        $this->assertInstanceOf('Gear\ValueObject\Db', $srcs[8***REMOVED***->getDb());
        $this->assertEquals(null, $srcs[8***REMOVED***->getExtends());
        $this->assertEquals(array(), $srcs[8***REMOVED***->getDependency());
    }
}
