<?php
namespace Gear\Common;

use Gear\Service\Filesystem\DirService;

trait DirServiceTrait {

    protected $dirService;

    public function getDirService()
    {
        if (!isset($this->dirService)) {
            $this->dirService = $this->getServiceLocator()->get('Gear\Service\Filesystem\Dir');
        }
        return $this->dirService;
    }

    public function setDirService(DirService $dirService)
    {
        $this->dirService = $dirService;
        return $this;
    }
}
