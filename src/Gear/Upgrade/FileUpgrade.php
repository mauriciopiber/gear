<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Project\ProjectServiceTrait;
use Gear\Module\ModuleServiceTrait;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\FileEdgeTrait;
use Gear\Project\ProjectLocationTrait;

class FileUpgrade extends AbstractJsonService
{
    use ProjectLocationTrait;

    use FileEdgeTrait;

    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    use ProjectServiceTrait;

    use ModuleServiceTrait;

    static public $created = 'Arquivo - Arquivo %s do %s criado';

    static public $confirm = 'Arquivo - Deseja criar arquivo %s?';

    protected $type;

    public function __construct($console, $consolePrompt, $moduleService, $projectService, $module = null)
    {
        $this->console = $console;
        $this->moduleService = $moduleService;
        $this->projectService = $projectService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
    }
    //use DirEdgeTrait;

    public function upgradeModule($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        //$mainFolder = $this->getModule()->getMainFolder();
        $this->edge = $this->getFileEdge()->getFileModule($type);

        if (isset($this->edge['files'***REMOVED***) && count($this->edge['files'***REMOVED***)) {
            foreach ($this->edge['files'***REMOVED*** as $file) {
                $this->upgradeModuleFile($type, $file);
            }
        }

        return $this->upgrades;
    }

    public function projectMap($type, $fileName)
    {
        $found = false;

        switch ($fileName) {
            case '.buildpath':
                $found = $this->getProjectService()->getBuildpath();
                break;
            case 'codeception.yml':
                $found = $this->getProjectService()->getCodeception();
                break;
            case 'script/deploy-development.sh':
                $found = $this->getProjectService()->getScriptDevelopment($type);
                break;
            case 'data/config.json':
                $found = $this->getProjectService()->getGulpfileConfig();
                break;
            case 'gulpfile.js':
                $found = $this->getProjectService()->getGulpfileJs();
                break;
            case 'end2end.conf.js':
                $found = $this->getProjectService()->getProtractorConfig();
                break;
            case 'karma.conf.js':
                $found = $this->getProjectService()->getKarmaConfig();
                break;
            case 'phinx.yml':
                $found = $this->getProjectService()->getPhinxConfig(null, null, null, null);
                break;
            case 'mkdocs.yml':
                $found = $this->getProjectService()->getConfigDocs();
                break;
            case 'docs/index.md':
                $found = $this->getProjectService()->getIndexDocs();
                break;
            case 'phpdox.xml':
                $found = $this->getProjectService()->getPhpdoxConfig();
                break;
            case 'script/deploy-staging.sh':
                $found = $this->getProjectService()->getScriptStaging();
                break;
            case 'script/deploy-testing.sh':
                $found = $this->getProjectService()->getScriptTesting();
                break;
            case 'README.md':
                $found = $this->getProjectService()->getReadme();
                break;
            case 'script/deploy-production.sh':
                $found = $this->getProjectService()->getScriptProduction();
                break;
            case 'phpmd.xml':
                $found = $this->getProjectService()->copyPHPMD();
                break;
            case 'phpcs-docs.xml':
                $found = $this->getProjectService()->getPhpcsDocs();
                break;

            default:
                $found = false;
        }


        if ($found === false) {
            throw new \Exception('Implementar mapa para arquivo '.$fileName);
        }

        return $found;

    }

    public function moduleMap($type, $fileName)
    {
        $found = false;

        switch ($fileName) {
            case 'codeception.yml':
                $found = $this->getModuleService()->getCodeception();
                break;
            case 'script/deploy-development.sh':
                $found = $this->getModuleService()->getScriptDevelopment($type);
                break;
            case 'data/config.json':
                $found = $this->getModuleService()->getGulpfileConfig();
                break;
            case 'gulpfile.js':
                 $found = $this->getModuleService()->getGulpfileJs();
                break;
            case 'public/js/spec/end2end.conf.js':
                $found = $this->getModuleService()->getProtractorConfig();
                break;
            case 'public/js/spec/karma.conf.js':
                $found = $this->getModuleService()->getKarmaConfig();
                break;
            case 'phinx.yml':
                $found = $this->getModuleService()->getPhinxConfig();
                break;
            case 'mkdocs.yml':
                $found = $this->getModuleService()->getConfigDocs();
                break;
            case 'docs/index.md':
                $found = $this->getModuleService()->getIndexDocs();
                break;
            case 'phpdox.xml':
                $found = $this->getModuleService()->getPhpdoxConfig();
                break;
            case 'test/unit.suite.yml':
                $found = $this->getModuleService()->getUnitSuiteConfig();
                break;
            case 'script/deploy-testing.sh':
                $found = $this->getModuleService()->getScriptTesting();
                break;
            case 'README.md':
                $found = $this->getModuleService()->getReadme();
                break;
            case 'schema/module.json':
                $found = $this->getModuleService()->getSchemaConfig();
                break;
            case 'test/phpmd.xml':
                $found = $this->getModuleService()->getPhpmdConfig();
                break;
            case 'test/phpunit-benchmark.xml':
                $found = $this->getModuleService()->getPhpunitBenchmarkConfig();
                break;

            case 'test/phpunit-coverage-benchmark.xml':
                $found = $this->getModuleService()->getPhpunitCoverageBenchmarkConfig();
                break;

            case 'test/phpcs-docs.xml':
                $found = $this->getModuleService()->getPhpcsDocsConfig();
                break;

            default:
                $found = false;
        }


        if ($found === false) {
            throw new \Exception('Implementar mapa para arquivo '.$fileName);
        }

        return $found;

    }

    public function upgradeModuleFile($type, $file)
    {
        $fileLocation = $this->getModule()->getMainFolder().'/'.$file;

        if (is_file($fileLocation)) {
            return;
        }

        if ($this->getConsolePrompt()->show(sprintf(static::$confirm, $file)) === false) {
            return;
        }

        if ($this->moduleMap($type, $file)) {
            $this->upgrades[***REMOVED*** = sprintf(static::$created, $file, 'Module');
        }

        return true;
    }

    public function upgradeProjectFile($type, $file)
    {
        $fileLocation = $this->getProject().'/'.$file;

        if (is_file($fileLocation)) {
            return;
        }

        if ($this->getConsolePrompt()->show(sprintf(static::$confirm, $file)) === false) {
            return;
        }

        if ($this->projectMap($type, $file)) {
            $this->upgrades[***REMOVED*** = sprintf(static::$created, $file, 'Project');
        }

        return true;
    }


    public function upgradeProject($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        //$mainFolder = $this->getModule()->getMainFolder();
        $this->edge = $this->getFileEdge()->getFileProject($type);

        if (isset($this->edge['files'***REMOVED***) && count($this->edge['files'***REMOVED***)) {
            foreach ($this->edge['files'***REMOVED*** as $file) {
                $this->upgradeProjectFile($type, $file);
            }
        }

        return $this->upgrades;

    }
}
