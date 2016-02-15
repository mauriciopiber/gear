<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;

class ConfigServiceTest extends AbstractTestCase
{
    use \Gear\Mvc\Config\ConfigServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $module = $this->getMockSingleClass('Gear\Module\BasicModuleStructure', array('getModuleName', 'getMainFolder', 'getConfigExtFolder'));
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

}
