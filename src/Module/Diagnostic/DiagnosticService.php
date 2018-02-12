<?php
namespace Gear\Module\Diagnostic;

use Gear\Diagnostic\AbstractDiagnostic;
use Gear\Diagnostic\Ant\{
    AntService,
    AntServiceTrait,
};
use Gear\Diagnostic\Composer\{
    ComposerService,
    ComposerServiceTrait,
};
use Gear\Diagnostic\File\{
    FileService,
    FileServiceTrait,
};
use Gear\Diagnostic\Dir\{
    DirService,
    DirServiceTrait,
};
use Gear\Diagnostic\Npm\{
    NpmService,
    NpmServiceTrait,
};

/**
 * Classe responsável por fazer o diagnóstico dos módulos para ter certeza que possui todos componentes
 * necessários para utilização do Gear, Jenkins.
 */
class DiagnosticService extends AbstractDiagnostic
{
    use AntServiceTrait;

    use ComposerServiceTrait;

    use FileServiceTrait;

    use DirServiceTrait;

    use NpmServiceTrait;

    /**
     * Construtor do diagnóstico
     *
     * @param Zend\Console $console
     * @param Gear\Module\BasicModuleStructure $module
     */
    public function __construct(
        $console,
        $module,
        AntService $antService,
        ComposerService $composerService,
        FileService $fileService,
        DirService $dirService,
        NpmService $npmService
    ) {
        $this->console = $console;
        $this->module = $module;
        $this->antService = $antService;
        $this->composerDiagService = $composerService;
        $this->fileDiagService = $fileService;
        $this->dirDiagService = $dirService;
        $this->npmService = $npmService;
    }

    public function diagnostic($type = 'web', $just = null)
    {
        $this->errors = [***REMOVED***;

        if ($this->checkJust($just) === false) {
            return false;
        }

        if ($just === null) {
            $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticModule($type));
            $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticModule($type));
            $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticModule($type));
            $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticModule($type));
            $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticModule($type));

            $this->show();

            return true;
        }


        switch ($just) {
            case 'composer':
                $this->errors = array_merge(
                    $this->errors,
                    $this->getComposerDiagnosticService()->diagnosticModule($type)
                );
                break;

            case 'ant':
                $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticModule($type));
                break;

            case 'npm':
                $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticModule($type));
                break;

            case 'file':
                $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticModule($type));
                break;

            case 'dir':
                $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticModule($type));
                break;

            default:
                $this->errors[***REMOVED*** = sprintf(self::NO_FOUND, $just);
                break;
        }

        $this->show();

        return true;
    }
}
