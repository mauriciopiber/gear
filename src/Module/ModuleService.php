<?php
/**
 * Gear.
 *
 * Gear Is The Edge Project From PiberNetwork.
 *
 * PHP VERSION 5.6
 *
 *  @category   Schema
 *  @package    Gear
 *  @subpackage Gear
 *  @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 *  @copyright  2014-2016 Mauricio Piber Fão
 *  @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 *  @link       https://bitbucket.org/mauriciopiber/gear
 */

namespace Gear\Module;

use Gear\Module\Config\ApplicationConfig;
use Gear\Module\Config\ApplicationConfigTrait;
use Gear\Autoload\ComposerAutoload;
use Gear\Autoload\ComposerAutoloadTrait;
use Gear\Cache\CacheServiceTrait;
use Gear\Cache\CacheService;
use Gear\Mvc\View\ViewServiceTrait;
use Gear\Mvc\View\App\AppControllerServiceTrait;
use Gear\Mvc\View\App\AppControllerService;
use Gear\Mvc\View\App\AppControllerSpecServiceTrait;
use Gear\Mvc\View\App\AppControllerSpecService;
use Gear\Mvc\ConsoleController\ConsoleControllerTestTrait;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Controller\Web\{
    WebControllerService,
    WebControllerServiceTrait,
    WebControllerTestService,
    WebControllerTestServiceTrait
};
use Gear\Mvc\Controller\Console\{
    ConsoleControllerService,
    ConsoleControllerServiceTrait,
    ConsoleControllerTestService,
    ConsoleControllerTestServiceTrait
};
use Gear\Mvc\Config\ConfigService;

use Gear\Version\VersionServiceTrait;
use Gear\Schema\Schema\SchemaServiceTrait;
use Gear\Schema\Schema\Loader\SchemaLoaderServiceTrait;
use Gear\Schema\Controller\ControllerSchemaTrait;
use Gear\Schema\Action\ActionSchemaTrait;
use Gear\Module\Tests\{
    ModuleTestsServiceTrait,
    ModuleTestsService
};
use Gear\Module\CodeceptionServiceTrait;
use Gear\Mvc\LanguageServiceTrait;
use Gear\Module\ComposerServiceTrait;
use Gear\Module\Node\GulpfileTrait;
use Gear\Module\Node\KarmaTrait;
use Gear\Module\Node\PackageTrait;
use Gear\Module\Node\ProtractorTrait;
use Gear\Module\Docs\DocsTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Docs\Docs;
use Gear\Module\CodeceptionService;

use Gear\Module\ComposerService;
use Gear\Module\Node\Gulpfile;
use Gear\Module\Node\Karma;
use Gear\Module\Node\Package;
use Gear\Module\Node\Protractor;
use Gear\Mvc\LanguageService;
use Gear\Schema\Schema\SchemaService as Schema;
use Gear\Schema\Schema\Loader\SchemaLoaderService as SchemaLoader;
use Gear\Schema\Controller\ControllerSchema as SchemaController;
use Gear\Schema\Action\ActionSchema as SchemaAction;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\Feature\FeatureTrait;
use Gear\Mvc\Spec\Step\Step;
use Gear\Mvc\Spec\Step\StepTrait;
use Gear\Mvc\Spec\Page\Page;
use Gear\Mvc\Spec\Page\PageTrait;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\Dir\DirServiceTrait;
use Gear\Util\Dir\DirService;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Mvc\View\ViewService;
use Gear\Config\GearConfig;
use Gear\Config\GearConfigTrait;
use Gear\Module\ConstructService;
use Gear\Module\ConstructServiceTrait;
use Gear\Constructor\Controller\ControllerConstructor;
use Gear\Constructor\Controller\ControllerConstructorTrait;
use Gear\Constructor\Action\ActionConstructor;
use Gear\Constructor\Action\ActionConstructorTrait;
use Gear\Docker\DockerService;
use Gear\Docker\DockerServiceTrait;
use Gear\Kube\KubeService;
use Gear\Kube\KubeServiceTrait;

/**
 *
 * Classe principal para Criação de Módulos.
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas,
 * Bem como a classe Module.php e suas dependências.
 *
 * @category   Schema
 * @package    Gear
 * @subpackage Gear
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class ModuleService
{
    use ModuleStructureTrait;
    use FileCreatorTrait;
    use StringServiceTrait;
    use FeatureTrait;
    use StepTrait;
    use PageTrait;
    use DocsTrait;
    use GulpfileTrait;
    use KarmaTrait;
    use PackageTrait;
    use ProtractorTrait;
    use ModuleTestsServiceTrait;
    use ComposerServiceTrait;
    use ViewServiceTrait;
    use CacheServiceTrait;
    use VersionServiceTrait;
    use ConfigServiceTrait;
    use CodeceptionServiceTrait;
    use LanguageServiceTrait;
    use SchemaServiceTrait;
    use SchemaLoaderServiceTrait;
    use ControllerSchemaTrait;
    use ActionSchemaTrait;
    use ApplicationConfigTrait;
    use ComposerAutoloadTrait;
    use DirServiceTrait;
    use GearConfigTrait;
    use ConstructServiceTrait;
    use DockerServiceTrait;
    use KubeServiceTrait;

    protected $type;

    protected $staging;

    const MODULE_AS_PROJECT = 1;

    const MODULE = 2;

    public function __construct(
        FileCreator $fileCreator,
        StringService $stringService,
        ModuleStructure $module,
        Docs $docs,
        ComposerService $composer,
        ModuleTestsService $test,
        Karma $karma,
        Protractor $protractor,
        Package $package,
        Gulpfile $gulpfile,
        LanguageService $language,
        Schema $schema,
        SchemaLoader $schemaLoader,
        ConfigService $configService,
        ViewService $viewService,
        $request,
        CacheService $cache,
        ApplicationConfig $applicationConfig,
        ComposerAutoload $autoload,
        array $config,
        DirService $dirService,
        GearConfig $gearConfig,
        ControllerConstructor $controllerConstructor,
        ActionConstructor $actionConstructor,
        DockerService $docker,
        KubeService $kube
    ) {
        $this->setKubeService($kube);
        $this->dockerService = $docker;
        $this->gearConfig = $gearConfig;
        $this->fileCreator = $fileCreator;
        $this->stringService = $stringService;
        $this->module = $module;
        $this->docs = $docs;
        $this->composerService = $composer;
        $this->moduleTestsService = $test;

        $this->karma = $karma;
        $this->protractor = $protractor;
        $this->package = $package;
        $this->gulpfile = $gulpfile;
        $this->languageService = $language;

        $this->schemaService = $schema;
        $this->schemaLoaderService = $schemaLoader;

        $this->configService = $configService;
        $this->viewService = $viewService;

        $this->request = $request;
        $this->cacheService = $cache;

        $this->applicationConfig = $applicationConfig;
        $this->composerAutoload = $autoload;
        $this->config = $config;

        $this->dirService = $dirService;

        $this->controllerConstructor = $controllerConstructor;
        $this->actionConstructor = $actionConstructor;
    }

    public function getModuleNamespace()
    {
        if (!strpos($this->getModule()->getModuleName(), '\\') !== false) {
            return $this->str('class', $this->getModule()->getModuleName());
        }

        $module = $this->getModule()->getModuleName();

        $pieces = explode('\\', $module);
        $fixStack = [***REMOVED***;

        foreach ($pieces as $index => $piece) {
            $fixStack[***REMOVED*** = $this->str('class', $piece);
        }

        return implode('\\', $fixStack);
    }

    /**
     * Cria módulos livres para ser utilizados as project.
     *
     * @param unknown $module Nome do Módulo
     * @param unknown $location Localização do Módulo
     * @param string $type Tipo Web|Cli
     *
     * @return boolean
     */
    public function moduleAsProject(
        $module,
        $location,
        $type = 'web',
        $staging = null
    ) {

        $this->type = $type;

        if (!in_array($this->type, [
            ModuleTypesInterface::CLI,
            ModuleTypesInterface::WEB,
            ModuleTypesInterface::SRC,
            ModuleTypesInterface::SRC_ZF2,
            ModuleTypesInterface::SRC_ZF3,
            ModuleTypesInterface::API,
        ***REMOVED***)) {
            throw new \Exception(sprintf('%s not a valid type', $type));
        }


        $this->staging = $staging;


        $moduleStructure = $this->getModule();

        if (!empty($location)) {
            $str = $this->getStringService();

            $mainFolder = $location.'/'.$str->str('url', $module);
            $moduleStructure->setMainFolder($mainFolder);
        }

        $module = $moduleStructure->prepare($module, $type)->write();

        return $this->moduleComponents(self::MODULE_AS_PROJECT);
    }

    public function createAdditionalViewFiles()
    {
        if ($this->type !== ModuleTypesInterface::WEB) {
            return;
        }

        $this->getViewService()->createErrorView();
        $this->getViewService()->createDeleteView();
        $this->getViewService()->create404View();
        //$viewService->createLayoutView();
        $this->getViewService()->createLayoutSuccessView();
        $this->getViewService()->createLayoutDeleteSuccessView();
        $this->getViewService()->createLayoutDeleteFailView();
        $this->getViewService()->createBreadcrumbView();
    }

    /**
     * Função que cria os componentes básicos para todos módulos, pode ser dividida.
     *
     * @param number $collection
     *
     * @return boolean
     */
    public function moduleComponents($collection = 2)
    {
        $configService = $this->getConfigService();
        $configService->module($this->type, $this->staging);

        $this->getComposerService()->createComposerAsProject($this->type);

        $this->createApplicationConfig($this->type);

        $this->createConfigGlobal();

        $this->createConfigLocal();

        $this->createPublicIndex();

        $this->createInitAutoloader();

        $this->createDeploy();

        $this->getPhinxConfig();

        $this->getModuleTestsService()->createTestsModuleAsProject($this->type);

        $this->createGitIgnore($this->type);

        $this->createModuleFile();

        $this->createDocs();


        $this->createKube();

        $this->createJenkinsFile($this->type);
        $this->createJenkinsPipeline($this->type);

        $this->createDockerCompose();
        $this->createDockerfile();

        if ($this->type === ModuleTypesInterface::WEB) {
            $this->getKarmaConfig();
            $this->getProtractorConfig();
            $this->getProtractor()->report();
            $this->getPackageConfig();
            $this->getGulpFileConfig();
            $this->getGulpFileJs();
            $this->createAdditionalViewFiles();

            if (!empty($this->staging)) {
                $this->getStagingScript();
                $this->getInstallStagingScript();
            }

            $languageService = $this->getLanguageService();
            $languageService->module();
        }

        $this->createIndex();
        return true;
    }

    public function createDockerCompose()
    {
        return $this->getDockerService()->createDockerComposeFile();
    }

    public function createDockerFile()
    {
        return $this->getDockerService()->createDockerfile();
    }

    public function createIndex()
    {
        if (in_array($this->type, [
            ModuleTypesInterface::WEB,
            ModuleTypesInterface::CLI,
            ModuleTypesInterface::API,
            ModuleTypesInterface::SRC_ZF2,
        ***REMOVED***)) {
            $this->registerJson();
        }

        if (in_array($this->type, [
            ModuleTypesInterface::WEB,
            ModuleTypesInterface::CLI,
            ModuleTypesInterface::API
        ***REMOVED***)) {
            $this->controllerConstructor->createModule($this->type);
            $this->actionConstructor->createModule($this->type);
        }
    }

    public function createGitIgnore($type)
    {
        $file = $this->getFileCreator();

        switch ($type) {
            case 'web':
                $template = 'web';
                break;
            default:
                $template = 'common';

        }


        $file->setTemplate(sprintf('template/module/git-ignore/gitignore-%s.phtml', $template));
        $file->setOptions([***REMOVED***);
        $file->setFileName('.gitignore');
        $file->setLocation($this->getModule()->getMainFolder());
        return $file->render();
    }

    /**
     * Cria o arquivo test/phpmd.xml
     */
    public function getPhpmdConfig()
    {
        return $this->getModuleTestsService()->copyphpmd();
    }

    /**
     * Cria o arquivo test/phpcs-docs.xml
     */
    public function getPhpcsDocsConfig()
    {
        return $this->getModuleTestsService()->copyDocSniff();
    }

    /**
     * Criar o arquivo test/unit.suite.yml
     */
    public function getUnitSuiteConfig()
    {
        return $this->getCodeceptionService()->unitSuiteYml();
    }

    /**
     * cria o arquivo phpdox.xml
     */
    public function getPhpdoxConfig()
    {
        return $this->getModuleTestsService()->copyphpdox();
    }

    /**
     * Executa a limpeza do cache de arquivos onde está as configurações,
     * pra próxima execução reconhcer o novo módulo.
     */
    public function cache()
    {
        $this->getCacheService()->renewFileCache();
    }

    public function getTemplate($type)
    {
        switch ($type) {
            case 'web':
                $template = 'web';
                break;
            case 'api':
                $template = 'api';
                break;
            case 'cli':
            case 'src':
            case 'src-zf2':
            case 'src-zf3':
                $template = 'cli';
                break;
        }
        return $template;
    }

    /**
     * Cria arquivo config/application.config.php para módulos as project
     *
     * @param string $type Tipo do módulo Web|Cli
     *
     * @return string
     */
    public function createJenkinsFile($type = 'web')
    {
        $template = $this->getTemplate($type);


        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/jenkinsfile/jenkinsfile-%s.phtml', $template));
        $file->setOptions(['moduleUrl' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('Jenkinsfile');
        $file->setLocation($this->getModule()->getMainFolder());
        return $file->render();
    }

    public function createJenkinsPipeline($type = 'api')
    {
        $template = $this->getTemplate($type);

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/jenkinsfile/pipeline-%s.phtml', $template));
        $file->setOptions(['moduleUrl' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('pipeline.yaml');
        $file->setLocation($this->getModule()->getMainFolder());
        return $file->render();

    }

    /**
     * Cria arquivo config/application.config.php para módulos as project
     *
     * @param string $type Tipo do módulo Web|Cli
     *
     * @return string
     */
    public function createApplicationConfig($type = 'web')
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/config/application-config/application.config.%s.phtml', $type));
        $file->setOptions(['module' => $this->getModule()->getNamespace()***REMOVED***);
        $file->setFileName('application.config.php');
        $file->setLocation($this->getModule()->getConfigFolder());
        return $file->render();
    }

    /**
     * Cria arquivo config/autoload/global.php para módulos as project
     *
     * @return string
     */
    public function createConfigGlobal()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/config/autoload/global.phtml');
        $file->setOptions(['module' => $this->str('uline', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('global.php');
        $file->setLocation($this->getModule()->getConfigAutoloadFolder());
        return $file->render();
    }

    /**
     * Cria arquivo config/autoload/local.php para módulos as project
     *
     * @return string
     */

    public function createConfigLocal()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/config/autoload/local.phtml');
        $file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('local.php');
        $file->setLocation($this->getModule()->getConfigAutoloadFolder());
        return $file->render();
    }

    /**
     * Cria arquivo public/index.php e arquivo public/.htaccess para módulos as project
     *
     * @return string
     */
    public function createPublicIndex()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/public/index.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('index.php');
        $file->setLocation($this->getModule()->getPublicFolder());
        $return = $file->render();


        $file = $this->getFileCreator();
        $file->setTemplate('template/module/public/htaccess.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('.htaccess');
        $file->setLocation($this->getModule()->getPublicFolder());
        $file->render();

        return $return;
    }

    /**
     * Cria arquivo init_autoloader.php para módulos as project
     *
     * @return string
     */
    public function createInitAutoloader()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/init_autoloader.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('init_autoloader.php');
        $file->setLocation($this->getModule()->getMainFolder());
        return $file->render();
    }

    /**
     * Cria script de deploy para ambiente de desenvolvimento
     *
     * @param string $type Tipo Web|Cli
     *
     * @return string
     */
    public function getScriptDevelopment($type)
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/script/deploy-development/deploy-development-%s.phtml', $type));
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);

        $file->setFileName('deploy-development.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }


    public function getStagingScript()
    {
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());

        $options = [***REMOVED***;
        $options['host'***REMOVED*** = $this->getStaging();
        $options['moduleUrl'***REMOVED*** = $moduleUrl;

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/script/deploy-staging.phtml');
        $file->setOptions($options);
        $file->setFileName('deploy-staging.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }

    public function getStaging()
    {
        if (empty($this->staging)) {
            $this->staging = $this->getGearConfig()->getCurrentStaging();
        }
        return $this->staging;
    }

    public function setStaging($staging)
    {
        $this->staging = $staging;
        return $this;
    }

    public function getInstallStagingScript()
    {
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());

        $options = [***REMOVED***;
        $options['host'***REMOVED*** = $this->getStaging();
        $options['moduleUrl'***REMOVED*** = $moduleUrl;
        $options['git'***REMOVED*** = $this->getConfigService()->getGit();
        $options['module'***REMOVED*** = $this->str('class', $this->getModule()->getModuleName());
        $options['dbFile'***REMOVED*** = sprintf('%s.mysql.sql', $moduleUrl);

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/script/install-remote-staging.phtml');
        $file->setOptions($options);
        $file->setFileName('install-staging.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }


    /**
     * Cria script de deploy para ambiente de teste
     *
     * @return string
     */
    public function getScriptTesting($type)
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/script/deploy-testing/deploy-testing-%s.phtml', $type));
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setFileName('deploy-testing.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }

    /**
     * Cria script de load, facilitador de sinalizador de atualizações completas no gear
     *
     * @return string
     */
    public function getScriptLoad($type)
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/script/load-%s.phtml', $type));
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setFileName('load.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }

    /**
     * Cria todos scripts obrigatórios para o módulo.
     */
    public function createDeploy()
    {
        $this->getScriptDevelopment($this->type);
        $this->getScriptTesting($this->type);

        if (in_array($this->type, [ModuleTypesInterface::WEB, ModuleTypesInterface::API***REMOVED***)) {
            $this->getScriptLoad($this->type);
        }

    }

    /**
     * Cria o arquivo phinx.xml para configuração das migrations
     *
     * @return string
     */
    public function getPhinxConfig()
    {
        $moduleUline = $this->str('uline', $this->getModule()->getModuleName());

        $template = 'template/module/phinx.phtml';
        $options = ['module' => $moduleUline***REMOVED***;
        $fileName = 'phinx.yml';
        $location = $this->getModule()->getMainFolder();

        $file = $this->getFileCreator();
        $file->setTemplate($template);
        $file->setOptions($options);
        $file->setFileName($fileName);
        $file->setLocation($location);

        return $file->render();
    }

    /**
     * Cria arquivo codeception.yml principal referência para os testes unitários
     *
     * @return string
     */
    public function getCodeception()
    {
        $codeceptionService = $this->getCodeceptionService();
        return $codeceptionService->codeceptYml();
    }

    /**
     * Cria arquivo README.md para informações principais do módulo
     *
     * @return string
     */
    public function getReadme()
    {
        return $this->getDocs()->createReadme();
    }

    public function createDocs()
    {
        $this->getDocs()->createConfig();
        $this->getDocs()->createChangelog();
        $this->getDocs()->createIndex();
        $this->getDocs()->createReadme();
    }

   /**
     * Cria arquivo package.json para pacotes nodejs
     *
     * @return string
     */
    public function getPackageConfig()
    {
        return $this->getPackage()->create();
    }

    /**
     * Cria arquivo public/js/spec/karma.conf.js para testes unitários js
     *
     * @return string
     */
    public function getKarmaConfig()
    {
        return $this->getKarma()->create();
    }

    /**
     * Cria arquivo public/js/spec/end2end.conf.js para testes de integração end2end
     *
     * @return string
     */
    public function getProtractorConfig()
    {
        return $this->getProtractor()->create();
    }

    /**
     * Cria arquivo data/config.js para configuração do gulpfile.js.
     *
     * @return string
     */
    public function getGulpfileConfig()
    {
        return $this->getGulpfile()->createFileConfig();
    }

    /**
     * Cria arquivo gulpfile.js para integração de arquivos js e css.
     *
     * @return string
     */
    public function getGulpfileJs()
    {
        return $this->getGulpfile()->createFile();
    }

    public function createKube()
    {
        return $this->getKubeService()->createKube();
    }
    /**
     * Cria arquivo src/$module/Module.php, arquivo principal com bootstrap do módulo
     *
     * @return string
     */
    public function createModuleFile()
    {
        $layoutName = 'gear-admin-interno';

        $this->createModuleFileTest();

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/src/module/module-%s.phtml', $this->type));
        $file->setOptions([
            'module' => $this->getModule()->getNamespace(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'layout' => $layoutName
        ***REMOVED***);

        $file->setFileName('Module.php');
        $file->setLocation($this->getModule()->getSrcModuleFolder());

        return $file->render();
    }

    /**
     * Cria teste unitário para classe Module, para garantir 100% de code coverage se necessário.
     *
     * @return string
     */
    public function createModuleFileTest()
    {
        $file = $this->getFileCreator();

        $file->setTemplate('template/module/test/module-test.phtml');
        $file->setOptions(
            array(
                'module' => $this->getModule()->getNamespace(),
            )
        );
        $file->setLocation($this->getModule()->getTestUnitModuleFolder());
        $file->setFileName('ModuleTest.php');

        return $file->render();
    }

    /**
     * Cria o arquivo schema/module.json básico para começar os trabalhos
     */
    public function getSchemaConfig()
    {
        $module = $this->getModule()->getModuleName();

        return $this->getSchemaService()->create($module);
    }

    /**
     * Cria os controllers e actions básicos para o módulo funcionar como Gear.
     *
     * @return array
     */
    public function registerJson()
    {
        $module = $this->getModule()->getModuleName();
        $this->getSchemaService()->create($module);
        $json = $this->getSchemaLoaderService()->loadSchema();
        return $json;
    }
}
