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
    ModuleTestsServiceTrait
};
use Gear\Util\String\StringServiceTrait;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Config\GearConfig;
use Gear\Config\GearConfigTrait;
use Gear\Module\Docs\Docs;
use Gear\Module\Docs\DocsTrait;

class FileUpgrade
{
    use DocsTrait;

    use ModuleStructureTrait;

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
        ModuleStructure $module,
        GearConfig $gearConfig,
        FileEdge $fileEdge,
        ConsolePrompt $consolePrompt,
        ModuleService $moduleService,
        ModuleTestsService $moduleTestsService,
        Docs $docs
    ) {
        $this->docs = $docs;
        $this->fileEdge = $fileEdge;
        $this->moduleService = $moduleService;
        $this->moduleTestsService = $moduleTestsService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
        $this->gearConfig = $gearConfig;
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
            /** @Deprecated  */
            case 'codeception.yml':
                return $this->getModuleService()->getCodeception();
            /** @Deprecated  */
            case 'script/deploy-development.sh':
                return $this->getModuleService()->getScriptDevelopment($type);
            /** @Deprecated  */
            case 'data/config.json':
                return $this->getModuleService()->getGulpfileConfig();
            /** @Deprecated  */
            case 'gulpfile.js':
                return $this->getModuleService()->getGulpfileJs();
            /** @Deprecated  */
            case 'public/js/spec/end2end.conf.js':
                return $this->getModuleService()->getProtractorConfig();
            /** @Deprecated  */
            case 'public/js/spec/karma.conf.js':
                return $this->getModuleService()->getKarmaConfig();
            /** @Deprecated  */
            case 'test/unit.suite.yml':
                return $this->getModuleService()->getUnitSuiteConfig();
            /** @Deprecated  */
            case 'script/deploy-testing.sh':
                return $this->getModuleService()->getScriptTesting($type);
            /** @Deprecated  */
            case 'script/deploy-staging.sh':
                return $this->getModuleService()->getStagingScript();
            /** @Deprecated  */
            case 'script/install-staging.sh':
                return $this->getModuleService()->getInstallStagingScript();
            /** @Deprecated  */
            case 'test/phpunit-benchmark.xml':
                return $this->getModuleTestsService()->createPhpunitBenchmarkConfigFile();
            /** @Deprecated  */
            case 'script/load.sh':
                return $this->getModuleService()->getScriptLoad($type);
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
            case 'schema/module.json':
                return $this->getModuleService()->getSchemaConfig();
            case 'test/phpmd.xml':
                return $this->getModuleService()->getPhpmdConfig();
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
            case 'docker-compose.yml':
            case 'docker-compose.yaml':
                return $this->getModuleService()->createDockerCompose();
            case 'Dockerfile':
                return $this->getModuleService()->createDockerFile();
            case 'kube.yaml':
                return $this->getModuleService()->createKube();
            case 'pipeline.yaml':
                return $this->getModuleService()->createJenkinsPipeline($type);
            default:
                throw new \Exception('Implementar mapa para arquivo '.$fileName);
        }
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
