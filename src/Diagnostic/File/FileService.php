<?php
namespace Gear\Diagnostic\File;

use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Edge\File\FileEdgeTrait;
use Gear\Edge\File\FileEdge;
use Gear\Module\Structure\ModuleStructureTrait;
use GearBase\Config\GearConfigTrait;
use GearBase\Config\GearConfig;

class FileService implements ModuleDiagnosticInterface
{
    use ModuleStructureTrait;

    use FileEdgeTrait;

    use GearConfigTrait;

    static public $missingFile = 'Arquivos - Faltando arquivo %s';

    public function __construct($module = null, GearConfig $config, FileEdge $fileEdge)
    {
        $this->gearConfig = $config;
        $this->fileEdge = $fileEdge;
        $this->module = $module;
    }

    public function diagnostic($baseDir, $edge)
    {
        foreach ($edge['files'***REMOVED*** as $file) {
            if (!is_file($baseDir.'/'.$file)) {
                $this->errors[***REMOVED*** = sprintf(static::$missingFile, $file);
            }
        }

        return $this->errors;
    }

    public function diagnosticEdge($edge)
    {
        if (!isset($edge['files'***REMOVED***) || empty($edge['files'***REMOVED***)) {
            throw new \Gear\Edge\File\Exception\MissingFiles();
        }
    }

    public function diagnosticModule($type = null)
    {
        if (empty($type)) {
            $type = $this->gearConfig->getCurrentType();
        }
        $this->errors = [***REMOVED***;

        $edge = $this->getFileEdge()->getFileModule($type);

        $this->diagnosticEdge($edge);


        $baseDir = $this->getModule()->getMainFolder();

        return $this->diagnostic($baseDir, $edge);
    }
}
