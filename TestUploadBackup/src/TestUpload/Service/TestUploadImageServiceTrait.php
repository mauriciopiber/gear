<?php
namespace TestUpload\Service;

use TestUpload\Service\TestUploadImageService;

trait TestUploadImageServiceTrait
{
    protected $testUploadImageService;

    public function getTestUploadImageService()
    {
        if (!isset($this->testUploadImageService)) {
            $serviceName = 'TestUpload\Service\TestUploadImageService';
            $this->testUploadImageService = $this->getServiceLocator()->get($serviceName);
        }
        return $this->testUploadImageService;
    }

    public function setTestUploadImageService(TestUploadImageService $testUploadImageService)
    {
        $this->testUploadImageService = $testUploadImageService;
        return $this;
    }
}
