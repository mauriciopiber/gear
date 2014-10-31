<?php
namespace GearGest\ConstructorTest;

use GearTest\AbstractGearTest;

class ViewTest extends AbstractGearTest
{
    protected $moduleName;

    public function setUp()
    {
        parent::setUp();
        $this->moduleName = 'MeuModulo';
        $this->service = $this->getServiceLocator()->get('viewConstructor');
        $this->service->setConfig($this->getMockConfig());
        $this->service->setTemplateService($this->getMockTemplate());

    }

    public function tearDown()
    {
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