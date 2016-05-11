<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

class DirService extends AbstractJsonService
{

    public function diagnosticModule()
    {
        $this->errors = [***REMOVED***;

        $this->isDirWritable($this->module->getDataLogsFolder());
        $this->isDirWritable($this->module->getBuildFolder());

        return $this->errors;
    }

    public function diagnosticCliModule()
    {
        $this->errors = [***REMOVED***;

        $this->isDirWritable($this->module->getBuildFolder());

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