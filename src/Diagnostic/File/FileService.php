<?php
namespace Gear\Diagnostic\File;

use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Edge\File\FileEdgeTrait;
use Gear\Module\ModuleAwareTrait;

class FileService implements ModuleDiagnosticInterface
{
    use ModuleAwareTrait;

    use FileEdgeTrait;

    static public $missingFile = 'Arquivos - Faltando arquivo %s';

    public function __construct($module = null)
    {
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

    public function diagnosticModule($type = 'web')
    {
        $this->errors = [***REMOVED***;

        $edge = $this->getFileEdge()->getFileModule($type);

        $this->diagnosticEdge($edge);


        $baseDir = $this->getModule()->getMainFolder();

        return $this->diagnostic($baseDir, $edge);
    }

    /*
    public function diagnosticModuleCli()
    {
        $this->errors = [***REMOVED***;

        $baseDir = $this->getModule()->getMainFolder();

        $expectedFiles = [
            //docs manual
            $baseDir.'/README.md',
            $baseDir.'/mkdocs.yml',
            $baseDir.'/docs/index.md',
            //docs php
            $baseDir.'/phpdox.xml',
            //migration
            $baseDir.'/phinx.yml',
            $baseDir.'/script/deploy-testing.sh',
            $baseDir.'/script/deploy-development.sh',
            //gulp
            //unit php
            $baseDir.'/codeception.yml',
            //autoload
            $baseDir.'/init_autoloader.php'
        ***REMOVED***;


        foreach ($expectedFiles as $file) {

            if (!is_file($file)) {
                $this->errors[***REMOVED*** = sprintf('Faltando arquivo %s', $file);
            }
        }


        return $this->errors;
    }
    */
}
