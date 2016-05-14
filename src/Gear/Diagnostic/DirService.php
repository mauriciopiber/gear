<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

class DirService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{

    public function diagnosticModuleWeb()
    {
        $this->errors = [***REMOVED***;

        $this->isDirWritable($this->module->getDataLogsFolder());
        $this->isDirWritable($this->module->getBuildFolder());

        return $this->errors;
    }

    public function diagnosticModuleCli()
    {
        $this->errors = [***REMOVED***;

        $this->isDirWritable($this->module->getBuildFolder());

        return $this->errors;
    }

    public function diagnosticProjectWeb()
    {

        $this->errors = [***REMOVED***;

        return $this->errors;
    }


    public function isDirWritable($baseDir)
    {
        if (!is_dir($baseDir)) {

            $this->errors[***REMOVED*** = sprintf(
                'Deves criar o diretório %s',
                $baseDir
            );

        }

        if (!is_writable($baseDir)) {

            $this->errors[***REMOVED*** = sprintf(
                'Deves dar permissão de escrita no diretório %s',
                $baseDir
            );

        }

        if (!is_file($baseDir.'/.gitignore')) {

            $this->errors[***REMOVED*** = sprintf(
                'Deve adicionar arquivo .gitignore para pasta %s',
                $baseDir
            );

        }
    }

}