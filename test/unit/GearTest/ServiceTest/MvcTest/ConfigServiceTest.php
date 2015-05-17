<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;

class ConfigServiceTest extends AbstractTestCase
{
    use \Gear\Common\ConfigServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getMainFolder', 'getConfigExtFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getMainFolder')->willReturn(__DIR__.'/_files');
        $module->expects($this->any())->method('getConfigExtFolder')->willReturn(__DIR__.'/_files');

        $this->module = $module;

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');
        $init = $schema->init();
        $schema->persistSchema($init);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');

        $this->getConfigService()->setModule($module);
        $this->getConfigService()->getTemplateService()->setRenderer($phpRenderer);
        $this->getConfigService()->setGearSchema($schema);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    public function testCreateServiceManagerWithoutKey()
    {
        $this->getConfigService()->mergeServiceManagerConfig();

        $expected = file_get_contents(__DIR__.'/_expected/service-manager-001.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/servicemanager.config.php');

        $this->assertEquals($expected, $actual);
    }

    public function getActions()
    {
        $controller = $this->getMockSingleClass('Gear\ValueObject\Controller', array('getName', 'getObject', 'getActions'));
        $controller->expects($this->any())->method('getName')->willReturn('ControllerName');
        $controller->expects($this->any())->method('getObject')->willReturn('\%\Controller\ControllerName');

        $action = $this->getMockSingleClass('Gear\ValueObject\Action', array('getController', 'getName', 'getRoute'));
        $action->expects($this->any())->method('getName')->willReturn('MyAction');
        $action->expects($this->any())->method('getRoute')->willReturn('my-action');

        $controller->expects($this->any())->method('getActions')->willReturn($action);
        $action->expects($this->any())->method('getController')->willReturn($controller);

        return array(
            array($action)
         );
    }

    /**
     * @group action
     */
    public function testMergeRouteByActions()
    {

        //load schema.json with a lot of actions

        $this->schema = $this->getMockSingleClass('Gear\Schema', array('getJsonFromFile', 'getModule'));
        $this->schema->expects($this->any())->method('getJsonFromFile')->willReturn(file_get_contents(__DIR__.'/_expected/schema-multiple-action.json'));
        $this->schema->expects($this->any())->method('getModule')->willReturn($this->module);
        $this->getConfigService()->setGearSchema($this->schema);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');
        $this->getConfigService()->getTemplateService()->setRenderer($phpRenderer);

        $this->getConfigService()->mergeRouterConfig();

        $this->assertFileExists(__DIR__.'/_files/route.config.php');

        $expected = file_get_contents(__DIR__.'/_expected/config/merge-route-001.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/route.config.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group action
     */
    public function testMergeNavigationByActions()
    {

        $this->schema = $this->getMockSingleClass('Gear\Schema', array('getJsonFromFile', 'getModule'));
        $this->schema->expects($this->any())->method('getJsonFromFile')->willReturn(file_get_contents(__DIR__.'/_expected/schema-multiple-action.json'));
        $this->schema->expects($this->any())->method('getModule')->willReturn($this->module);
        $this->getConfigService()->setGearSchema($this->schema);

        $this->getConfigService()->mergeNavigationConfig();

        $this->assertFileExists(__DIR__.'/_files/navigation.config.php');

        $expected = file_get_contents(__DIR__.'/_expected/config/merge-navigation-001.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/navigation.config.php');

        $this->assertEquals($expected, $actual);
    }

   /*  public function testCreateServiceWithSrcWithoutType()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('export'));
        $src->expects($this->any())->method('export')->willReturn(array(
            'name' => 'PrimeiroTeste',
            'type' => null,
            'namespace' => 'MyFolder\MyOtherFolder'
        ));

        $this->getConfigService()->getGearSchema()->insertSrc($src);

        $this->getConfigService()->mergeServiceManagerConfig();

        $expected = file_get_contents(__DIR__.'/_expected/service-manager-002.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/servicemanager.config.php');

        $this->assertEquals($expected, $actual);
    } */
}
