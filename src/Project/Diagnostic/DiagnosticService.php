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

    public function diagnostic($type, $just = null)
    {
        $this->baseDir = $this->getBaseDir();

        if ($this->checkJust($just) === false) {
            return false;
        }

        if (!is_dir(!$this->baseDir.'/module')
            && is_file($this->baseDir.'/Module.php')
        ) {
            $this->showCheck('Execute esse comando apenas no contexto de Projeto.');
            return false;
        }

        if ($just === null) {
            $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticProject($type));
            $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticProject($type));
            $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticProject($type));
            $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticProject($type));
            $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticProject($type));

            $this->show();

            return true;
        }


        switch ($just) {
            case 'composer':
                $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticProject($type));
                break;

            case 'ant':
                $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticProject($type));
                break;

            case 'npm':
                $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticProject($type));
                break;

            case 'file':
                $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticProject($type));
                break;

            case 'dir':
                $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticProject($type));
                break;

            default:
                $this->errors[***REMOVED*** = sprintf(self::NO_FOUND, $just);
                break;
        }

        $this->show();

        return true;
    }
}
