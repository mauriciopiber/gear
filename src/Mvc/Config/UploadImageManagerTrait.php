<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\UploadImageManagers;

trait UploadImageManagerTrait
{
    protected $uploadImage;

    public function getUploadImageManager()
    {
        return $this->uploadImage;
    }

    public function setUploadImageManager($uploadImage)
    {
        $this->uploadImage = $uploadImage;
        return $this;
    }
}
