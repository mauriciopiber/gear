<?php
namespace Gear\Diagnostic\File;

use Gear\Service\AbstractJsonService;
use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Diagnostic\ProjectDiagnosticInterface;
use Gear\Edge\FileEdgeTrait;

class FileService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use FileEdgeTrait;

    static public $missingFile = 'Faltando arquivo %s';

    public function __construct($module)
    {
        $this->module = $module;
    }

    public function diagnosticProject($type = 'web')
    {
        $this->errors = [***REMOVED***;

        $edge = $this->getFileEdge()->getFileModule($type);

        if (!isset($edge['files'***REMOVED***) || empty($edge['files'***REMOVED***)) {
            throw new \Gear\Edge\FileEdge\Exception\MissingFiles();
        }

        $baseDir = $this->getModule()->getMainFolder();

        $expectedFiles = [
            //docs manual
            $baseDir.'/README.md',
            $baseDir.'/mkdocs.yml',
            $baseDir.'/docs/index.md',
            //docs php
            $baseDir.'/phpdox.yml',
            //migration
            $baseDir.'/phinx.yml',
            //cucumber protractor
            //$baseDir.'/public/js/spec/end2end.conf.js',
            //karma jasmine
            //$baseDir.'/public/js/spec/karma.conf.js',
            //scripts
            $baseDir.'/script/deploy-testing.sh',
            $baseDir.'/script/deploy-development.sh',
            //gulp
            $baseDir.'/gulpfile.js',
            $baseDir.'/data/config.json',
            //unit php
            $baseDir.'/codeception.yml',
            //autoload
            $baseDir.'/init_autoloader.php'


        ***REMOVED***;


        foreach ($expectedFiles as $file) {

            if (!is_file($file)) {
                $this->errors[***REMOVED*** = sprintf(static::$missingFile, $file);
            }
        }


        return $this->errors;
    }

    public function diagnosticModule($type = 'web')
    {
        $this->errors = [***REMOVED***;

        $edge = $this->getFileEdge()->getFileModule($type);

        if (!isset($edge['files'***REMOVED***) || empty($edge['files'***REMOVED***)) {
            throw new \Gear\Edge\FileEdge\Exception\MissingFiles();
        }

        $baseDir = $this->getModule()->getMainFolder();

        foreach ($edge['files'***REMOVED*** as $file) {

            if (!is_file($baseDir.'/'.$file)) {
                $this->errors[***REMOVED*** = sprintf(static::$missingFile, $file);
            }
        }


        return $this->errors;
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
