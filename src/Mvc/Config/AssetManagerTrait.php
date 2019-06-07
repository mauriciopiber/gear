<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\AssetManager;

trait AssetManagerTrait
{
    protected $assetManager;

    public function setAssetManager($assetManager)
    {
        $this->assetManager = $assetManager;
    }

    public function getAssetManager()
    {
        return $this->assetManager;
    }
}
