<?php
namespace Gear\Diagnostic\File;

use Gear\Service\AbstractJsonService;
use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Diagnostic\ProjectDiagnosticInterface;
use Gear\Edge\FileEdgeTrait;
use Gear\Project\ProjectLocationTrait;

class FileService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use ProjectLocationTrait;

    use FileEdgeTrait;

    static public $missingFile = 'Arquivos - Faltando arquivo %s';

    public function __construct($module = null)
    {
        $this->module = $module;
    }

    public function diagnosticProject($type = 'web')
    {
        $this->errors = [***REMOVED***;

        $edge = $this->getFileEdge()->getFileProject($type);

        $this->diagnosticEdge($edge);

        $baseDir = $this->getProject();

        return $this->diagnostic($baseDir, $edge);
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
            throw new \Gear\Edge\FileEdge\Exception\MissingFiles();
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
