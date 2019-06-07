<?php
namespace Gear\Diagnostic\Dir;

use Gear\Diagnostic\Dir\DirService;

trait DirServiceTrait
{
    protected $dirDiagService;

    public function getDirDiagnosticService()
    {
        return $this->dirDiagService;
    }

    public function setDirDiagnosticService(DirService $dirService)
    {
        $this->dirDiagService = $dirService;
        return $this;
    }
}
