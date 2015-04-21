<?php
namespace TestUpload\Repository;

use TestUpload\Repository\TestUploadImageRepository;

trait TestUploadImageRepositoryTrait
{
    protected $testUploadImageRepository;

    public function getTestUploadImageRepository()
    {
        if (!isset($this->testUploadImageRepository)) {
            $serviceName = 'TestUpload\Repository\TestUploadImageRepository';
            $this->testUploadImageRepository = $this->getServiceLocator()->get($serviceName);
        }
        return $this->testUploadImageRepository;
    }

    public function setTestUploadImageRepository(TestUploadImageRepository $testUploadImageRepository)
    {
        $this->testUploadImageRepository = $testUploadImageRepository;
        return $this;
    }
}
