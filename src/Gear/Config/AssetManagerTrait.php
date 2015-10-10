<?php
namespace Gear\Config;

trait AssetManagerTrait {

    protected $assetManager;

    public function setAssetManager($assetManager)
    {
        $this->assetManager = $assetManager;
    }

    public function getAssetManager()
    {
        if (!isset($this->assetManager)) {
            $this->assetManager = $this->getServiceLocator()->get('Gear\Config\AssetManager');
        }
        return $this->assetManager;
    }
}
