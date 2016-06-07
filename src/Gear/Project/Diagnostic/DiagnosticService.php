<?php
namespace Gear\Project\Diagnostic;

use Gear\Diagnostic\AbstractDiagnostic;

class DiagnosticService extends AbstractDiagnostic
{
    public static $SATIS = 'https://mirror.pibernetwork.com';

    public function setBaseDir($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    public function getBaseDir()
    {
        if (!isset($this->baseDir)) {
            $this->baseDir = \GearBase\Module::getProjectFolder();
        }
        return $this->baseDir;
    }

    public function __construct($console)
    {
        $this->console = $console;
    }

    public function diagnostic($type)
    {
        $this->baseDir = $this->getBaseDir();

        if (
            !is_dir(!$this->baseDir.'/module')
            && is_file($this->baseDir.'/Module.php')
        ) {
            $this->showCheck('Execute esse comando apenas no contexto de Projeto.');
            return false;
        }

        $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticProject($type));
        $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticProject($type));
        $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticProject($type));
        $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticProject($type));
        $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticProject($type));

        $this->show();

        return true;

    }
}
