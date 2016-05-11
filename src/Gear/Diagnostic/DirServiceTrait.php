<?php
namespace Gear\Diagnostic;

use Gear\Diagnostic\DirService;

trait DirServiceTrait
{
    protected $dirDiagService;

    public function getDirDiagnosticService()
    {
        if (!isset($this->dirDiagService)) {
            $this->dirDiagService = $this->getServiceLocator()->get('Gear\Diagnostic\Dir');
        }
        return $this->dirDiagService;
    }

    public function setDirDiagnosticService(DirService $dirService)
    {
        $this->dirDiagService = $dirService;
        return $this;
    }
}
