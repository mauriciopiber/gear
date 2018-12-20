<?php
namespace Gear\Diagnostic\File;

use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Edge\File\FileEdgeTrait;
use Gear\Edge\File\FileEdge;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Config\GearConfigTrait;
use Gear\Config\GearConfig;
use Gear\Locator\ModuleLocatorTrait;

class FileService implements ModuleDiagnosticInterface
{
    use ModuleLocatorTrait;

    use ModuleStructureTrait;

    use FileEdgeTrait;

    use GearConfigTrait;

    static public $missingFile = 'Arquivos - Faltando arquivo %s';

    public function __construct($module = null, GearConfig $config, FileEdge $fileEdge)
    {
        $this->gearConfig = $config;
        $this->fileEdge = $fileEdge;
        $this->module = $module;

        $this->dir = $this->getModule()->getMainFolder();
        if (empty($this->dir)) {
          $this->dir = $this->getModuleFolder();
        }

        $this->moduleName = $this->getModule()->getModuleName();

        if (empty($this->moduleName)) {
          $this->moduleName = $this->gearConfig->getCurrentName();
        }
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

        return $this->diagnostic($this->dir, $edge);
    }
}
