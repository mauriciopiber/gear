<?php
namespace Gear\Diagnostic\Dir;

use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Edge\Dir\DirEdgeTrait;
use Gear\Edge\Dir\DirEdge;
use GearBase\Config\GearConfigTrait;
use GearBase\Config\GearConfig;

class DirService implements ModuleDiagnosticInterface
{
    use ModuleStructureTrait;

    use DirEdgeTrait;

    static public $missingIgnore = 'Diretório - Deve adicionar arquivo .gitignore para pasta %s';

    static public $missingDir = 'Diretório - Deves criar o diretório %s';

    static public $missingWrite = 'Diretório - Deves dar permissão de escrita no diretório %s';

    public function __construct($module = null, GearConfig $config, DirEdge $dirEdge)
    {
        $this->gearConfig = $config;
        $this->dirEdge = $dirEdge;
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

    public function diagnosticEdge($edge)
    {
        if (!isset($edge['writable'***REMOVED***)) {
            throw new \Gear\Edge\Dir\Exception\MissingWritable();
        }

        if (!isset($edge['ignore'***REMOVED***)) {
            throw new \Gear\Edge\Dir\Exception\MissingIgnore();
        }
    }

    public function diagnosticModule($type = null)
    {
        if (empty($type)) {
            $type = $this->gearConfig->getCurrentType();
        }
        $this->errors = [***REMOVED***;

        $edge = $this->getDirEdge()->getDirModule($type);

        $this->diagnosticEdge($edge);


        return $this->diagnostic($this->module->getMainFolder(), $edge);
    }

    public function diagnostic($baseDir, $edge)
    {
        $this->errors = [***REMOVED***;

        if (count($edge['writable'***REMOVED***) > 0) {
            foreach ($edge['writable'***REMOVED*** as $folder) {
                $this->isDirWritable($baseDir, $folder);
            }
        }

        if (count($edge['ignore'***REMOVED***) > 0) {
            foreach ($edge['ignore'***REMOVED*** as $folder) {
                $this->isDirIgnorable($baseDir, $folder);
            }
        }

        return $this->errors;
    }

    public function isDirIgnorable($baseDir, $folder)
    {
        $fullpath = $baseDir.'/'.$folder;

        if (!is_file($fullpath.'/.gitignore')) {
            $this->errors[***REMOVED*** = sprintf(
                static::$missingIgnore,
                $folder
            );
        }
    }

    public function isDirWritable($baseDir, $folder)
    {
        $fullpath = $baseDir.'/'.$folder;

        if (!is_dir($fullpath)) {
            $this->errors[***REMOVED*** = sprintf(
                static::$missingDir,
                $folder
            );

            return;
        }

        if (!is_writable($fullpath)) {
            $this->errors[***REMOVED*** = sprintf(
                static::$missingWrite,
                $folder
            );
        }
    }
}
