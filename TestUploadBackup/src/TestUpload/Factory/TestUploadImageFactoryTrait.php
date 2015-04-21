<?php
namespace TestUpload\Factory;

use TestUpload\Factory\TestUploadImageFactory;

trait TestUploadImageFactoryTrait
{
    protected $testUploadImageFactory;

    public function getTestUploadImageFactory()
    {
        if (!isset($this->testUploadImageFactory)) {
            $serviceName = 'TestUpload\Factory\TestUploadImageFactory';
            $this->testUploadImageFactory = $this->getServiceLocator()->get($serviceName);
        }
        return $this->testUploadImageFactory;
    }

    public function setTestUploadImageFactory(TestUploadImageFactory $testUploadImageFactory)
    {
        $this->testUploadImageFactory = $testUploadImageFactory;
        return $this;
    }
}
