<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class BasicModuleStructureTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();
        $this->structure = $this->getServiceLocator()->get('moduleStructure');
        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->willReturn('TestModule');
        $this->structure->setConfig($mockConfig);
    }

    public function testCanGetByServiceLocator()
    {

        $this->assertInstanceOf('\Gear\ValueObject\BasicModuleStructure', $this->structure);
    }

    public function testPrepareCanSetValuesProperty()
    {

        $structure = $this->structure->prepare();

        $this->assertEquals('TestModule', $structure->getModuleName());
        $this->assertEquals('/var/www/html/modules/module/TestModule', $structure->getMainFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/config', $structure->getConfigFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/config/ext', $structure->getConfigExtFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/config/acl', $structure->getConfigAclFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/config/jenkins', $structure->getConfigJenkinsFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/build', $structure->getBuildFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/schema', $structure->getSchemaFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/data', $structure->getDataFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/language', $structure->getLanguageFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src', $structure->getSrcFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule', $structure->getSrcModuleFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule/Controller', $structure->getControllerFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule/Entity', $structure->getEntityFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule/Factory', $structure->getFactoryFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule/Form', $structure->getFormFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule/Filter', $structure->getFilterFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule/Repository', $structure->getRepositoryFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule/Service', $structure->getServiceFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/src/TestModule/ValueObject', $structure->getValueObjectFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/view', $structure->getViewFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/view/test-module', $structure->getViewModuleFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/view/error', $structure->getViewErrorFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/view/layout', $structure->getViewLayoutFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/view/test-module/index', $structure->getViewIndexControllerFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test', $structure->getTestFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/_data', $structure->getTestDataFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/_support', $structure->getTestSupportFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/Pages', $structure->getTestPagesFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/acceptance', $structure->getTestAcceptanceFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/functional', $structure->getTestFunctionalFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/unit', $structure->getTestUnitFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/unit/TestModuleTest', $structure->getTestUnitModuleFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/unit/TestModuleTest/ControllerTest', $structure->getTestControllerFolder());
        $this->assertEquals('/var/www/html/modules/module/TestModule/test/unit/TestModuleTest/ServiceTest', $structure->getTestServiceFolder());
    }

    public function testWriteModuleSuccessfully()
    {
        $structure = $this->structure->prepare()->write();

        $this->assertEquals('TestModule', $structure->getModuleName());
        $this->assertTrue(is_dir($structure->getMainFolder()));
        $this->assertTrue(is_dir($structure->getConfigFolder()));
        $this->assertTrue(is_dir($structure->getConfigExtFolder()));
        $this->assertTrue(is_dir($structure->getConfigAclFolder()));
        $this->assertTrue(is_dir($structure->getConfigJenkinsFolder()));
        $this->assertTrue(is_dir($structure->getBuildFolder()));
        $this->assertTrue(is_dir($structure->getSchemaFolder()));
        $this->assertTrue(is_dir($structure->getDataFolder()));
        $this->assertTrue(is_dir($structure->getLanguageFolder()));
        $this->assertTrue(is_dir($structure->getSrcFolder()));
        $this->assertTrue(is_dir($structure->getSrcModuleFolder()));
        $this->assertTrue(is_dir($structure->getControllerFolder()));
        $this->assertTrue(is_dir($structure->getEntityFolder()));
        $this->assertTrue(is_dir($structure->getFactoryFolder()));
        $this->assertTrue(is_dir($structure->getFormFolder()));
        $this->assertTrue(is_dir($structure->getFilterFolder()));
        $this->assertTrue(is_dir($structure->getRepositoryFolder()));
        $this->assertTrue(is_dir($structure->getServiceFolder()));
        $this->assertTrue(is_dir($structure->getValueObjectFolder()));
        $this->assertTrue(is_dir($structure->getViewFolder()));
        $this->assertTrue(is_dir($structure->getViewModuleFolder()));
        $this->assertTrue(is_dir($structure->getViewErrorFolder()));
        $this->assertTrue(is_dir($structure->getViewLayoutFolder()));
        $this->assertTrue(is_dir($structure->getViewIndexControllerFolder()));
        $this->assertTrue(is_dir($structure->getTestFolder()));
        $this->assertTrue(is_dir($structure->getTestDataFolder()));
        $this->assertTrue(is_dir($structure->getTestSupportFolder()));
        $this->assertTrue(is_dir($structure->getTestPagesFolder()));
        $this->assertTrue(is_dir($structure->getTestAcceptanceFolder()));
        $this->assertTrue(is_dir($structure->getTestFunctionalFolder()));
        $this->assertTrue(is_dir($structure->getTestUnitFolder()));
        $this->assertTrue(is_dir($structure->getTestUnitModuleFolder()));
        $this->assertTrue(is_dir($structure->getTestControllerFolder()));
        $this->assertTrue(is_dir($structure->getTestServiceFolder()));
    }
}

