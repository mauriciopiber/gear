<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\UploadImageManagers;

trait UploadImageManagerTrait
{
    protected $uploadImage;

    public function getUploadImageManager()
    {
        if (!isset($this->uploadImage)) {
            $this->uploadImage = $this->getServiceLocator()->get(UploadImageManager::class);
        }
        return $this->uploadImage;
    }

    public function setUploadImageManager($uploadImage)
    {
        $this->uploadImage = $uploadImage;
        return $this;
    }
}
