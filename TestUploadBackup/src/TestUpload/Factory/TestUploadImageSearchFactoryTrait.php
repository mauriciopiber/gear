<?php
namespace TestUpload\Factory;

use TestUpload\Factory\TestUploadImageSearchFactory;

trait TestUploadImageSearchFactoryTrait
{
    protected $testUploadImageSearchFactory;

    public function getTestUploadImageSearchFactory()
    {
        if (!isset($this->testUploadImageSearchFactory)) {
            $serviceName = 'TestUpload\Form\Search\TestUploadImageSearchForm';
            $this->testUploadImageSearchFactory = $this->getServiceLocator()->get($serviceName);
        }
        return $this->testUploadImageSearchFactory;
    }

    public function setTestUploadImageSearchFactory(TestUploadImageSearchFactory $testUploadImageSearchFactory)
    {
        $this->testUploadImageSearchFactory = $testUploadImageSearchFactory;
        return $this;
    }
}
