<?php
namespace Gear\Upgrade\File;

use Gear\Module\ModuleServiceTrait;
use Gear\Module\ModuleService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Console\Prompt\ConsolePromptTrait;
use Gear\Edge\File\FileEdgeTrait;
use Gear\Edge\File\FileEdge;
use Gear\Locator\ModuleLocatorTrait;
use Gear\Module\Tests\{
    ModuleTestsService,
    ModuleTestsServiceTrait
};
use Gear\Util\String\StringServiceTrait;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Console\Prompt\ConsolePrompt;
use Gear\Config\GearConfig;
use Gear\Config\GearConfigTrait;
use Gear\Module\Docs\Docs;
use Gear\Module\Docs\DocsTrait;
use Gear\Docker\DockerService;
use Gear\Docker\DockerServiceTrait;

class FileUpgrade
{
    use DocsTrait;

    use DockerServiceTrait;

    use ModuleStructureTrait;

    use StringServiceTrait;

    use ModuleLocatorTrait;

    use FileEdgeTrait;

    use ConsolePromptTrait;

    use GearConfigTrait;

    use ModuleServiceTrait;

    use ModuleTestsServiceTrait;

    static public $created = 'Arquivo - Arquivo %s do %s criado';

    static public $confirm = 'Arquivo - Deseja criar arquivo %s?';

    protected $type;

    public function __construct(
        ModuleStructure $module,
        GearConfig $gearConfig,
        FileEdge $fileEdge,
        ConsolePrompt $consolePrompt,
        ModuleService $moduleService,
        ModuleTestsService $moduleTestsService,
        Docs $docs,
        DockerService $dockerService
    ) {
        $this->dockerService = $dockerService;
        $this->docs = $docs;
        $this->fileEdge = $fileEdge;
        $this->moduleService = $moduleService;
        $this->moduleTestsService = $moduleTestsService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
        $this->gearConfig = $gearConfig;
        $this->dir = $this->getModule()->getMainFolder();
        if (empty($this->dir)) {
          $this->dir = $this->getModuleFolder();
        }

        $this->moduleName = $this->getModule()->getModuleName();

        if (empty($this->moduleName)) {
          $this->moduleName = $this->gearConfig->getCurrentName();
        }
    }
    //use DirEdgeTrait;

    public function upgradeModule($type = null)
    {
        if (empty($type)) {
            $type = $this->gearConfig->getCurrentType();
        }
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

    public function moduleMap($type, $fileName)
    {
        $found = false;

        switch ($fileName) {
            case 'codeception.yml':
                return $this->getModuleService()->getCodeception();
            case 'script/deploy-development.sh':
                return $this->getModuleService()->getScriptDevelopment($type);
            case 'data/config.json':
                return $this->getModuleService()->getGulpfileConfig();
            case 'gulpfile.js':
                 return $this->getModuleService()->getGulpfileJs();
            case 'public/js/spec/end2end.conf.js':
                return $this->getModuleService()->getProtractorConfig();
            case 'public/js/spec/karma.conf.js':
                return $this->getModuleService()->getKarmaConfig();
            case 'phinx.yml':
                return $this->getModuleService()->getPhinxConfig();
            case 'mkdocs.yml':
                return $this->docs->createConfig();
            case 'docs/index.md':
                return $this->docs->createIndex();
            case 'docs/CHANGELOG.md':
                return $this->docs->createChangelog();
            case 'README.md':
                return $this->docs->createReadme();
            case 'phpdox.xml':
                return $this->getModuleService()->getPhpdoxConfig();
            case 'test/unit.suite.yml':
                return $this->getModuleService()->getUnitSuiteConfig();
            case 'script/deploy-testing.sh':
                return $this->getModuleService()->getScriptTesting($type);
            case 'script/deploy-staging.sh':
                return $this->getModuleService()->getStagingScript();
            case 'script/install-staging.sh':
                return $this->getModuleService()->getInstallStagingScript();
            case 'script/load.sh':
                return $this->getModuleService()->getScriptLoad($type);
            case 'schema/module.json':
                return $this->getModuleService()->getSchemaConfig();
            case 'test/phpmd.xml':
                return $this->getModuleService()->getPhpmdConfig();
            case 'test/phpunit-benchmark.xml':
                return $this->getModuleTestsService()->createPhpunitBenchmarkConfigFile();
            case 'test/phpunit.xml':
                return $this->getModuleTestsService()->createPhpunitConfigFile();
            case 'test/phpunit-coverage.xml':
                return $this->getModuleTestsService()->createPhpunitCoverageConfigFile();
            case 'test/phpunit-ci.xml':
                return $this->getModuleTestsService()->createPhpunitCiConfigFile();
            case 'test/phpunit-coverage-ci.xml':
                return $this->getModuleTestsService()->createPhpunitCoverageCiConfigFile();
            case 'test/phpcs.xml':
                return $this->getModuleService()->getPhpcsDocsConfig();
            case 'Jenkinsfile':
                return $this->getModuleService()->createJenkinsFile($type);
            case '.gitignore':
                return $this->getModuleService()->createGitIgnore($type);
            case '.dockerignore':
                return $this->getDockerService()->createDockerIgnoreFile();
            case 'docker-compose.yml':
                return $this->getDockerService()->createDockerComposeFile();
            case 'Dockerfile':
                return $this->getDockerService()->createDockerBuildFile();
            case 'entrypoint.sh':
                return $this->getDockerService()->createDockerEntryPointFile();
            default:
                throw new \Exception('Implementar mapa para arquivo '.$fileName);
        }
    }

    public function upgradeModuleFile($type, $file)
    {
        $fileLocation = $this->dir.'/'.$file;

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
        $fileLocation = $this->getModuleFolder().'/'.$file;

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
