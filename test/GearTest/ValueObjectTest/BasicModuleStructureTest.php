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

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testCanGetByServiceLocator()
    {

        $this->assertInstanceOf('\Gear\ValueObject\BasicModuleStructure', $this->structure);
    }

    public function testPrepareCanSetValuesProperty()
    {

        $structure = $this->structure->prepare();


        $folder = \Gear\Service\ProjectService::getProjectFolder();

        $this->assertEquals('TestModule', $structure->getModuleName());
        $this->assertEquals($folder.'/module/TestModule', $structure->getMainFolder());
        $this->assertEquals($folder.'/module/TestModule/config', $structure->getConfigFolder());
        $this->assertEquals($folder.'/module/TestModule/config/ext', $structure->getConfigExtFolder());
        $this->assertEquals($folder.'/module/TestModule/config/acl', $structure->getConfigAclFolder());
        $this->assertEquals($folder.'/module/TestModule/config/jenkins', $structure->getConfigJenkinsFolder());
        $this->assertEquals($folder.'/module/TestModule/build', $structure->getBuildFolder());
        $this->assertEquals($folder.'/module/TestModule/schema', $structure->getSchemaFolder());
        $this->assertEquals($folder.'/module/TestModule/data', $structure->getDataFolder());
        $this->assertEquals($folder.'/module/TestModule/language', $structure->getLanguageFolder());
        $this->assertEquals($folder.'/module/TestModule/src', $structure->getSrcFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule', $structure->getSrcModuleFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule/Controller', $structure->getControllerFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule/Entity', $structure->getEntityFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule/Factory', $structure->getFactoryFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule/Form', $structure->getFormFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule/Filter', $structure->getFilterFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule/Repository', $structure->getRepositoryFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule/Service', $structure->getServiceFolder());
        $this->assertEquals($folder.'/module/TestModule/src/TestModule/ValueObject', $structure->getValueObjectFolder());
        $this->assertEquals($folder.'/module/TestModule/view', $structure->getViewFolder());
        $this->assertEquals($folder.'/module/TestModule/view/test-module', $structure->getViewModuleFolder());
        $this->assertEquals($folder.'/module/TestModule/view/error', $structure->getViewErrorFolder());
        $this->assertEquals($folder.'/module/TestModule/view/layout', $structure->getViewLayoutFolder());
        $this->assertEquals($folder.'/module/TestModule/view/test-module/index', $structure->getViewIndexControllerFolder());
        $this->assertEquals($folder.'/module/TestModule/test', $structure->getTestFolder());
        $this->assertEquals($folder.'/module/TestModule/test/_data', $structure->getTestDataFolder());
        $this->assertEquals($folder.'/module/TestModule/test/_support', $structure->getTestSupportFolder());
        $this->assertEquals($folder.'/module/TestModule/test/Pages', $structure->getTestPagesFolder());
        $this->assertEquals($folder.'/module/TestModule/test/acceptance', $structure->getTestAcceptanceFolder());
        $this->assertEquals($folder.'/module/TestModule/test/functional', $structure->getTestFunctionalFolder());
        $this->assertEquals($folder.'/module/TestModule/test/unit', $structure->getTestUnitFolder());
        $this->assertEquals($folder.'/module/TestModule/test/unit/TestModuleTest', $structure->getTestUnitModuleFolder());
        $this->assertEquals($folder.'/module/TestModule/test/unit/TestModuleTest/ControllerTest', $structure->getTestControllerFolder());
        $this->assertEquals($folder.'/module/TestModule/test/unit/TestModuleTest/ServiceTest', $structure->getTestServiceFolder());
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

