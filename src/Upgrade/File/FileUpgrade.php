<?php
namespace Gear\Upgrade\File;

use Gear\Module\ModuleServiceTrait;
use Gear\Module\ModuleService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\File\FileEdgeTrait;
use Gear\Edge\File\FileEdge;
use Gear\Project\ProjectLocationTrait;
use Gear\Module\Tests\{
    ModuleTestsService,
    ModuleTestsServiceTrait,
};
use GearBase\Util\String\StringServiceTrait;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\BasicModuleStructure;
use Gear\Util\Prompt\ConsolePrompt;
use GearBase\Config\GearConfig;
use GearBase\Config\GearConfigTrait;

class FileUpgrade
{
    use ModuleAwareTrait;

    use StringServiceTrait;

    use ProjectLocationTrait;

    use FileEdgeTrait;

    use ConsolePromptTrait;

    use GearConfigTrait;

    use ModuleServiceTrait;

    use ModuleTestsServiceTrait;

    static public $created = 'Arquivo - Arquivo %s do %s criado';

    static public $confirm = 'Arquivo - Deseja criar arquivo %s?';

    protected $type;

    public function __construct(
        BasicModuleStructure $module,
        GearConfig $gearConfig,
        FileEdge $fileEdge,
        ConsolePrompt $consolePrompt,
        ModuleService $moduleService,
        ModuleTestsService $moduleTestsService
    ) {
        $this->fileEdge = $fileEdge;
        $this->moduleService = $moduleService;
        $this->moduleTestsService = $moduleTestsService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
        $this->gearConfig = $gearConfig;
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
            case 'data/report.js':
                $found = $this->getProjectService()->getProtractorReportConfig();
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
            case 'docs/CHANGELOG.md':
                $found = $this->getProjectService()->getChangelogDocs();
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
            case 'script/load.sh':
                $found = $this->getProjectService()->getScriptLoad();
                break;
            case 'README.md':
                $found = $this->getProjectService()->getReadme();
                break;
            case 'script/deploy-production.sh':
                $found = $this->getProjectService()->getScriptProduction();
                break;
            case 'script/install-production.sh':
                $found = $this->getProjectService()->getScriptInstallProduction();
                break;
            case 'script/install-staging.sh':
                $found = $this->getProjectService()->getScriptInstallStaging();
                break;
            case 'phpmd.xml':
                $found = $this->getProjectService()->copyPHPMD();
                break;
            case 'phpcs.xml':
                $found = $this->getProjectService()->getPhpcsDocs();
                break;
            case 'Jenkinsfile':
                $found = $this->getProjectService()->createJenkinsFile();
                break;
            case '.gitignore':
                $found = $this->getProjectService()->createGitIgnore();
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
            case 'docs/CHANGELOG.md':
                $found = $this->getModuleService()->getChangelogDocs();
                break;
            case 'phpdox.xml':
                $found = $this->getModuleService()->getPhpdoxConfig();
                break;
            case 'test/unit.suite.yml':
                $found = $this->getModuleService()->getUnitSuiteConfig();
                break;

            case 'script/deploy-testing.sh':
                $found = $this->getModuleService()->getScriptTesting($type);
                break;
            case 'script/deploy-staging.sh':
                $found = $this->getModuleService()->getStagingScript();
                break;
            case 'script/install-staging.sh':
                $found = $this->getModuleService()->getInstallStagingScript();
                break;
            case 'script/load.sh':
                $found = $this->getModuleService()->getScriptLoad($type);
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
                $found = $this->getModuleTestsService()->createPhpunitBenchmarkConfigFile();
                break;
            case 'test/phpunit.xml':
                $found = $this->getModuleTestsService()->createPhpunitConfigFile();
                break;
            case 'test/phpunit-coverage.xml':
                $found = $this->getModuleTestsService()->createPhpunitCoverageConfigFile();
                break;
            case 'test/phpunit-ci.xml':
                $found = $this->getModuleTestsService()->createPhpunitCiConfigFile();
                break;
            case 'test/phpunit-coverage-ci.xml':
                $found = $this->getModuleTestsService()->createPhpunitCoverageCiConfigFile();
                break;
            case 'test/phpcs.xml':
                $found = $this->getModuleService()->getPhpcsDocsConfig();
                break;
            case 'Jenkinsfile':
                $found = $this->getModuleService()->createJenkinsFile($type);
                break;
            case '.gitignore':
                $found = $this->getModuleService()->createGitIgnore($type);
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
}
