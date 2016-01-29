<?php
namespace Gear\Mvc\Config;

trait UploadImageTrait {

    protected $uploadImage;

    public function getUploadImage()
    {
        if (!isset($this->uploadImage)) {
            $this->uploadImage = $this->getServiceLocator()->get('Gear\Mvc\Config\UploadImage');
        }
        return $this->uploadImage;
    }

    public function setUploadImage($uploadImage)
    {
        $this->uploadImage = $uploadImage;
        return $this;
    }
}
