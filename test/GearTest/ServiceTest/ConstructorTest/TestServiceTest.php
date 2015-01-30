<?php
namespace GearGest\ServiceTest;

use GearTest\AbstractGearTest;

class TestServiceTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();
        $this->moduleName = 'ModuleTest';
        $this->service = $this->getServiceLocator()->get('testConstructor');
        $this->service->setConfig($this->getMockConfig());

        $mockTemplate = $this->getMockBuilder('Gear\Service\TemplateService')->getMock();

        $mockTemplate->expects($this->any())
        ->method('render')
        ->willReturn(true);

        $mockFile = $this->getMockBuilder('Gear\Service\Filesystem\FileService')->getMock();

        $mockFile->expects($this->any())
        ->method('factory')
        ->willReturn(true);

        $this->service->setFileService($mockFile);
        $this->service->setTemplateService($mockTemplate);
    }

    public function tearDown()
    {
        $project = \Gear\Service\ProjectService::getProjectFolder();
        $this->service->getDirService()->rmDir($project.'/module/'.$this->moduleName);
        parent::tearDown();
    }


    public function testAssertServiceManager()
    {
        $this->assertInstanceOf('Gear\Service\Constructor\TestService', $this->service);
    }

    public function testFailSuiteNotFound()
    {
        $data = array(
            'target' => 'dirone/dirtwo/dirthree/test.php',
            'suite' => 'accep3tance'
        );

        $testCreated = $this->service->create($data);
        $this->assertFalse($testCreated);
    }

    public function testCreateTestAcceptance()
    {

        $data = array(
        	'target' => 'dirone/dirtwo/dirthree/test.php',
            'suite' => 'acceptance'
        );

        $testCreated = $this->service->create($data);
        $this->assertTrue($testCreated);
    }

    public function testCreateFunctionalTest()
    {
        $data = array(
            'target' => 'dirone/dirthree/test.php',
            'suite' => 'functional'
        );

        $testCreated = $this->service->create($data);
        $this->assertTrue($testCreated);
    }

    public function testCreateWithoutTargetFail()
    {
        $data = array(
            'target' => '',
            'suite' => 'functional'
        );

        $testCreated = $this->service->create($data);
        $this->assertFalse($testCreated);
    }

    public function testCreateWithoutDataFail()
    {
        $data = array(
            'target' => 'dirone/dirtwo/dirthree/test.php',
            'suite' => ''
        );

        $testCreated = $this->service->create($data);
        $this->assertFalse($testCreated);
    }
}
