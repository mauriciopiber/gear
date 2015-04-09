<?php
namespace Gear\Service;

trait VersionServiceTrait {

    protected $versionService;

    public function getVersionService()
    {
        if (!isset($this->versionService)) {
            $this->versionService = $this->getServiceLocator()->get('Gear\Service\Version');
        }
        return $this->versionService;
    }

    public function setVersionService($versionService)
    {
        $this->versionService = $versionService;
        return $this;
    }
}
