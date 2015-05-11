<?php
namespace GearGest\ConstructorTest;

use GearTest\AbstractGearTest;

class ViewTest extends AbstractGearTest
{
    protected $moduleName;

    public function setUp()
    {
        parent::setUp();
        $this->moduleName = 'ModuleTest';
        $this->service = $this->getServiceLocator()->get('viewConstructor');
        $this->service->setConfig($this->getMockConfig());
        $this->service->setTemplateService($this->getMockTemplate());
    }

    public function tearDown()
    {
        $project = \Gear\Service\ProjectService::getProjectFolder();
        $this->service->getDirService()->rmDir($project.'/module/'.$this->moduleName);
        parent::tearDown();

    }

    public function testAssertServiceManager()
    {
        $this->assertInstanceOf('Gear\Service\Constructor\ViewService', $this->service);
    }

    public function testCreateReturnsFalseWithFalseArray()
    {
        $data = $this->service->create(array());
        $this->assertFalse($data);
    }


    public function testCreateReturnsTrueWithTrue()
    {
        $data = $this->service->create(array('target' => 'main/test.phtml'));
        $this->assertTrue($data);
    }

}