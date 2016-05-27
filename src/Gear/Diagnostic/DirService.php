<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

class DirService extends AbstractJsonService //implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{

    public function diagnosticModuleWeb()
    {
        $this->errors = [***REMOVED***;


        $this->isDirIgnorable($this->module->getBuildFolder());
        $this->isDirIgnorable($this->module->getDataDoctrineProxyCacheFolder());
        $this->isDirIgnorable($this->module->getDataDoctrineModuleCacheFolder());
        $this->isDirIgnorable($this->module->getSessionFolder());
        $this->isDirIgnorable($this->module->getDataLogsFolder());
        $this->isDirWritable($this->module->getDataMigrationFolder());


        //$this->isDirWritable($this->module->getDataFolder());


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

        $this->baseDir = \GearBase\Module::getProjectFolder();

        $this->isDirWritable($this->baseDir.'/data/logs');
        $this->isDirWritable($this->baseDir.'/data/DoctrineORMModule/Proxy');
        $this->isDirWritable($this->baseDir.'/data/DoctrineModule/cache');
        $this->isDirWritable($this->baseDir.'/data/cache/configcache');
        $this->isDirWritable($this->baseDir.'/data/session');
        $this->isDirWritable($this->baseDir.'/build');

        return $this->errors;
    }

    public function isDirIgnorable($baseDir)
    {

        $this->isDirWritable($baseDir);


        if (!is_file($baseDir.'/.gitignore')) {

            $this->errors[***REMOVED*** = sprintf(
                'Deve adicionar arquivo .gitignore para pasta %s',
                $baseDir
            );

        }
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
    }

}