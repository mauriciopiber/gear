<?php
namespace GearTest\ServiceTest\ConstructorTest;

use GearBaseTest\AbstractTestCase;
use Gear\Service\Constructor\ControllerServiceTrait;

class ControllerServiceTest extends AbstractTestCase
{
    use ControllerServiceTrait;

    public function setUp()
    {
        parent::setUp();
        unset($this->controllerService);
        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getControllerFolder', 'getTestControllerFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getControllerFolder')->willReturn(__DIR__.'/_files');
        $module->expects($this->any())->method('getTestControllerFolder')->willReturn(__DIR__.'/_files');
        $this->getControllerService()->setModule($module);

        $controller     = $this->getMockSingleClass('Gear\Service\Mvc\ControllerService', array('implement'));
        $controller->expects($this->any())->method('implement')->willReturn(true);
        $this->getControllerService()->setControllerService($controller);

        $controllerTest = $this->getMockSingleClass('Gear\Service\Test\ControllerTestService', array('implement'));
        $controllerTest->expects($this->any())->method('implement')->willReturn(true);
        $this->getControllerService()->setControllerTestService($controllerTest);

        $config         = $this->getMockSingleClass('Gear\Service\Mvc\ConfigService', array('mergeControllerConfig'));
        $config->expects($this->any())->method('mergeControllerConfig')->willReturn(true);
        $this->getControllerService()->setConfigService($config);


        $schema = $this->getMockSingleClass('Gear\Schema', array('addController'));
        $schema->expects($this->any())->method('addController')->willReturn(true);
        $this->getControllerService()->setGearSchema($schema);


       /*  $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../view');

        $this->getControllerService()->getTemplateService()->setRenderer($phpRenderer); */
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @dataProvider controllerDataSet
     * @group controller-001
     */
    public function testCreateController($name, $object, $isValid)
    {
        $created = $this->getControllerService()->create(array('name' => $name, 'object' => $object));
        $this->assertSame($isValid, $created);
    }

    public function controllerDataSet()
    {
        return array(
        	array(
        	    'Internacional', '%s\Controller\Internacional', true
            ),
            array(
                'Gremio', '%s\Controller\Gremio', true
            )
        );
    }
}
