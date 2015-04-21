<?php
namespace TestUpload\TestUploadTest\FormTest;

/**
 * @group Form
 */
class TestUploadImageFormTest extends \PHPUnit_Framework_TestCase
{
    protected $testUploadImageFo;

    protected function setUp()
    {
        $this->bootstrap = new \TestUpload\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getTestUploadImageForm()
    {
        if (!isset($this->testUploadImageFo)) {
            $this->testUploadImageFo = $this->bootstrap->getServiceLocator()->get(
                'TestUpload\Factory\TestUploadImageFactory'
            );
        }
        return $this->testUploadImageFo;
    }

    /**
     * @group TestUpload
     * @group TestUploadImageForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTestUploadImageForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group TestUpload
     * @group TestUploadImageForm
     */
    public function testCallUsingServiceLocator()
    {
        $testUploadImageFo = $this->getTestUploadImageForm();
        $this->assertInstanceOf('TestUpload\Form\TestUploadImageForm', $testUploadImageFo);
    }
}
