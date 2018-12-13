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
        if (!isset($this->assetManager)) {
            $this->assetManager = $this->getServiceLocator()->get(AssetManager::class);
        }
        return $this->assetManager;
    }
}
