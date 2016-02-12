<?php
namespace Gear\Mvc\Config;

trait UploadImageManagerTrait
{
    protected $uploadImage;

    public function getUploadImageManager()
    {
        if (!isset($this->uploadImage)) {
            $this->uploadImage = $this->getServiceLocator()->get('Gear\Mvc\Config\UploadImage');
        }
        return $this->uploadImage;
    }

    public function setUploadImageManager($uploadImage)
    {
        $this->uploadImage = $uploadImage;
        return $this;
    }
}
