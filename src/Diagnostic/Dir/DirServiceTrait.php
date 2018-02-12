<?php
namespace Gear\Diagnostic\Dir;

use Gear\Diagnostic\Dir\DirService;

trait DirServiceTrait
{
    protected $dirDiagService;

    public function getDirDiagnosticService()
    {
        if (!isset($this->dirDiagService)) {
            $this->dirDiagService = $this->getServiceLocator()->get('Gear\Diagnostic\Dir\DirService');
        }
        return $this->dirDiagService;
    }

    public function setDirDiagnosticService(DirService $dirService)
    {
        $this->dirDiagService = $dirService;
        return $this;
    }
}
