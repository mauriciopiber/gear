<?php
namespace Gear\Diagnostic\Dir;

use Gear\Service\AbstractJsonService;
use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Diagnostic\ProjectDiagnosticInterface;

class DirService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use \Gear\Edge\DirEdgeTrait;

    static public $missingIgnore = 'Deve adicionar arquivo .gitignore para pasta %s';

    static public $missingDir = 'Deves criar o diretório %s';

    static public $missingWrite = 'Deves dar permissão de escrita no diretório %s';

    public function __construct($module)
    {
        $this->module = $module;
    }

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

    public function diagnosticModule($type = 'web')
    {
        $this->errors = [***REMOVED***;


        $edge = $this->getDirEdge()->getDirModule($type);

        if (!isset($edge['writable'***REMOVED***)) {
            throw new \Gear\Edge\Dir\Exception\MissingWritable();
        }

        if (!isset($edge['ignore'***REMOVED***)) {
            throw new \Gear\Edge\Dir\Exception\MissingIgnore();
        }

        if (count($edge['writable'***REMOVED***) > 0) {
            foreach ($edge['writable'***REMOVED*** as $folder) {
                $this->isDirWritable($folder);
            }
        }

        if (count($edge['ignore'***REMOVED***) > 0) {
            foreach ($edge['ignore'***REMOVED*** as $folder) {
                $this->isDirIgnorable($folder);
            }
        }

        //$this->isDirWritable($this->module->getBuildFolder());

        return $this->errors;
    }

    public function diagnosticProject($type = 'web')
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

    public function isDirIgnorable($folder)
    {
        $baseDir = $this->module->getMainFolder().'/'.$folder;

        //$this->isDirWritable($baseDir);

        if (!is_file($baseDir.'/.gitignore')) {

            $this->errors[***REMOVED*** = sprintf(
                static::$missingIgnore,
                $folder
            );

        }
    }

    public function isDirWritable($folder)
    {
        $baseDir = $this->module->getMainFolder().'/'.$folder;

        if (!is_dir($baseDir)) {

            $this->errors[***REMOVED*** = sprintf(
                static::$missingDir,
                $folder
            );

            return;

        }

        if (!is_writable($baseDir)) {

            $this->errors[***REMOVED*** = sprintf(
                static::$missingWrite,
                $folder
            );

        }
    }
}
