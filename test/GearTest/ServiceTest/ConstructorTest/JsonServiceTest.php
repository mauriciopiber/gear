<?php
namespace Gear\ServiceTest\ConstructorTest;

class JsonServiceTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->bootstrap   = new \GearTest\Bootstrap();

        $this->jsonService = $this->bootstrap->getServiceLocator()->get('jsonService');

        $this->testDir     = __DIR__.'/../../../temp';

        $this->mockSchemaFile = realpath(__DIR__.'/../../_mockfiles/module.json');

        $this->mockSchemaJson = '{"TesteModule":{"src":[***REMOVED***,"controller":[{"name":"IndexController","object":"Controller\\\Index","actions":[{"name":"index","route":"teste-module\/index","role":"guest"}***REMOVED***}***REMOVED***,"db":[***REMOVED***}}';


        $this->createTestDir();

        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('TesteModule'));

        $mockConfig->expects($this->any())
        ->method('getModuleFolder')
        ->will($this->returnValue($this->testDir));

        $this->jsonService->setConfig($mockConfig);
    }

    public function createTestDir()
    {
        $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
        $dirService->mkDir($this->testDir);
        $dirService->mkDir($this->testDir.'/schema');
    }


    public function tearDown()
    {
        /* @var $dirService \Gear\Service\Filesystem\DirService */
        $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
        //$dirService->rmDir($this->testDir);
        unset($this->bootstrap);

    }
    /**
     * @group rev2
     */
    public function testCreateNewModuleJson()
    {
        $data = $this->jsonService->createNewModuleJson();
        $this->assertCreateNewModuleJson($data);

        return $data;
    }

    public function assertCreateNewModuleJson($data)
    {
        $this->assertTrue(is_array($data));

        $this->assertArrayHasKey('TesteModule', $data);

        $this->assertArrayHasKey('src', $data['TesteModule'***REMOVED***);
        $this->assertArrayHasKey('db', $data['TesteModule'***REMOVED***);
        $this->assertArrayHasKey('controller', $data['TesteModule'***REMOVED***);

        $this->assertEquals(0, count($data['TesteModule'***REMOVED***['src'***REMOVED***));
        $this->assertEquals(0, count($data['TesteModule'***REMOVED***['db'***REMOVED***));
        $this->assertEquals(1, count($data['TesteModule'***REMOVED***['controller'***REMOVED***));

        $this->assertTrue(is_array($data['TesteModule'***REMOVED***['src'***REMOVED***));
        $this->assertTrue(is_array($data['TesteModule'***REMOVED***['db'***REMOVED***));
        $this->assertTrue(is_array($data['TesteModule'***REMOVED***['controller'***REMOVED***));

    }


    /**
     * @depends testCreateNewModuleJson
     */
    public function testSaveJsonSuccessful($data)
    {
        $encode = $this->jsonService->encode($data);
        $this->assertJson($encode);

        $dataFake = $this->mockSchemaJson;

        $this->assertEquals($encode, $dataFake);
        $this->assertJson($dataFake);
        $this->assertJson($encode);


        $this->assertJsonStringEqualsJsonString(
            $encode,
            $dataFake
        );

        return $encode;
    }


    /**
     * @depends testSaveJsonSuccessful
     */
    public function testWriteJsonIntoDisc($data)
    {
        $data = $this->jsonService->writeJson($data);
        $actualFile = realpath($data);
        $this->assertJsonFileEqualsJsonFile($this->mockSchemaFile, $actualFile);

        return $actualFile;
    }

    public function testLoadInvalidJsonFile()
    {
        $file = $this->jsonService->loadFromFile('testinahudfha');
        $this->assertNull($file);
    }

    /**
     * @depends testWriteJsonIntoDisc
     * @param unknown $data
     */
    public function testReadJsonSaveOnDisct($data)
    {
        $file = $this->jsonService->loadFromFile($data);

        $this->assertJson($file);
        $this->assertEquals($file, $this->mockSchemaJson);

        return $file;
    }


    /**
     * @depends testReadJsonSaveOnDisct
     */
    public function testDecodeBackToStdClass($data)
    {
        $file = $this->jsonService->decode($data);
        $this->assertCreateNewModuleJson($file);
    }


    /**
     * @dataProvider controllerFixture
     */
    public function testInsertControllerIntoJson($name, $object)
    {
        $schema = $this->jsonService->loadFromFile($this->mockSchemaFile);
        $schemaArray = $this->jsonService->decode($schema);

        $dataToValue = array(
        	'name' => $name,
            'object' => $object
        );

        $controller = new \Gear\ValueObject\Controller($dataToValue);

        $jsonWithController = $this->jsonService->insertIntoJson($schemaArray, $controller);

        $this->assertJson(json_encode($jsonWithController));

        $this->assertArrayHasKey('TesteModule', $jsonWithController);
        $this->assertArrayHasKey('controller', $jsonWithController['TesteModule'***REMOVED***);
        $this->assertCount(2, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***);
    }


    public function testInsertFirstController()
    {
        $schema = $this->jsonService->loadFromFile($this->mockSchemaFile);
        $schemaArray = $this->jsonService->decode($schema);

        $dataToValue = array(
            'name' => 'MeuPrimeiroController',
            'object' => '%s\Controller\MeuPrimeiro'
        );

        $controller = new \Gear\ValueObject\Controller($dataToValue);

        $jsonWithController = $this->jsonService->insertIntoJson($schemaArray, $controller);

        $this->assertJson(json_encode($jsonWithController));

        $this->assertArrayHasKey('TesteModule', $jsonWithController);
        $this->assertArrayHasKey('controller', $jsonWithController['TesteModule'***REMOVED***);
        $this->assertCount(2, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***);

        return $jsonWithController;
    }

    /**
     * @depends testInsertFirstController
     */

    public function testInsertSecondController($schemaArray)
    {
        $dataToValue = array(
            'name' => 'MeuSegundoController',
            'object' => '%s\Controller\MeuSegundo'
        );

        $controller = new \Gear\ValueObject\Controller($dataToValue);

        $jsonWithController = $this->jsonService->insertIntoJson($schemaArray, $controller);

        $this->assertJson(json_encode($jsonWithController));

        $this->assertArrayHasKey('TesteModule', $jsonWithController);
        $this->assertArrayHasKey('controller', $jsonWithController['TesteModule'***REMOVED***);
        $this->assertCount(3, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***);

        return $jsonWithController;
    }

    /**
     * @depends testInsertSecondController
     */

    public function testInsertThirdController($schemaArray)
    {
        $dataToValue = array(
            'name' => 'MeuTerceiroController',
            'object' => '%s\Controller\MeuTerceiro'
        );

        $controller = new \Gear\ValueObject\Controller($dataToValue);
        $jsonWithController = $this->jsonService->insertIntoJson($schemaArray, $controller);

        $this->assertJson(json_encode($jsonWithController));

        $this->assertArrayHasKey('TesteModule', $jsonWithController);
        $this->assertArrayHasKey('controller', $jsonWithController['TesteModule'***REMOVED***);
        $this->assertCount(4, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***);

        return $jsonWithController;
    }

    /**
     * @depends testInsertThirdController
     */

    public function testInsertFourthController($schemaArray)
    {
        $dataToValue = array(
            'name' => 'MeuQuartoController',
            'object' => '%s\Controller\MeuQuarto'
        );

        $controller = new \Gear\ValueObject\Controller($dataToValue);
        $jsonWithController = $this->jsonService->insertIntoJson($schemaArray, $controller);

        $this->assertJson(json_encode($jsonWithController));

        $this->assertArrayHasKey('TesteModule', $jsonWithController);
        $this->assertArrayHasKey('controller', $jsonWithController['TesteModule'***REMOVED***);
        $this->assertCount(5, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***);
        $this->assertEquals($jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***[4***REMOVED***['name'***REMOVED***, 'MeuQuartoController');
        $this->assertEquals($jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***[4***REMOVED***['object'***REMOVED***, '%s\Controller\MeuQuarto');

        return $jsonWithController;
    }


    /**
     * @depends testInsertFourthController
     * @param unknown $schemaArray
     */
    public function testActionInsertFirstActionIntoController($schemaArray)
    {
        $this->assertJson(json_encode($schemaArray));

        $dataAction = array(
        	'controller' => 'MeuQuartoController',
            'name' => 'myaction',
        );

        $action = new \Gear\ValueObject\Action($dataAction);

        $jsonWithController = $this->jsonService->insertIntoJson($schemaArray, $action);

        $this->assertJson(json_encode($jsonWithController));
        $this->assertCount(5, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***);
        $this->assertCount(1, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***[4***REMOVED***['actions'***REMOVED***);

        return $jsonWithController;
    }

    /**
     * @depends testActionInsertFirstActionIntoController
     */
    public function testActionInsertSecoundActionInto($schemaArray)
    {
        $this->assertJson(json_encode($schemaArray));

        $dataAction = array(
            'controller' => 'MeuQuartoController',
            'name' => 'mytwoaction',
        );

        $action = new \Gear\ValueObject\Action($dataAction);

        $jsonWithController = $this->jsonService->insertIntoJson($schemaArray, $action);

        $this->assertJson(json_encode($jsonWithController));
        $this->assertCount(5, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***);
        $this->assertCount(2, $jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***[4***REMOVED***['actions'***REMOVED***);
        $this->assertEquals($jsonWithController['TesteModule'***REMOVED***['controller'***REMOVED***[4***REMOVED***['actions'***REMOVED***[1***REMOVED***['name'***REMOVED***, 'mytwoaction');

        return $jsonWithController;
    }



    public function controllerFixture()
    {
        return array(
            array(
                'MyControllerIntoJson', '%s\Controller\MyControllerIntoJson'
            ),
            array(
                'TwoControllerIntoJson', '%s\Controller\TwoControllerIntoJson'
            ),
        );
    }
}
