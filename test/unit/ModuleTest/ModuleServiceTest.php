<?php
namespace GearTest\ModuleTest;

use GearTest\UtilTestTrait;
use Gear\Module\ModuleTypesInterface;
use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Constructor\Controller\ControllerConstructor;
use Gear\Constructor\Action\ActionConstructor;
use Symfony\Component\Yaml\Parser;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\ComposerService;
use Gear\Module\Tests\ModuleTestsService;
use Gear\Schema\Schema\SchemaService;
use Gear\Schema\Schema\Loader\SchemaLoaderService;
use Gear\Schema\Controller\ControllerSchema as ControllerSchema;
use Gear\Schema\Action\ActionSchema;
use Gear\Mvc\Controller\Console\{
    ConsoleControllerService,
    ConsoleControllerTestService,
};
use Gear\Mvc\Controller\ControllerTestService;
use Gear\Mvc\Controller\ControllerService;
use Gear\Module\CodeceptionService;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\View\App\AppControllerService;
use Gear\Mvc\View\App\AppControllerSpecService;
use Gear\Mvc\View\ViewService;
use Gear\Module\Node\Gulpfile;
use Gear\Module\Node\Package;
use Gear\Module\Node\Karma;
use Gear\Module\Node\Protractor;
use Gear\Module\Docs\Docs;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\UnitTest\UnitTest;
use Gear\Mvc\Spec\Page\Page;
use Gear\Mvc\Spec\Step\Step;
use Gear\Cache\CacheService;
use Zend\Console\Request;
use Gear\Module\Config\ApplicationConfig;
use Gear\Autoload\ComposerAutoload;
use Gear\Module;
use Gear\Creator\Template\TemplateService;
use Gear\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\Dir\DirService;
use Gear\Util\String\StringService;
use Gear\Module\ModuleService;
use Gear\Mvc\Controller\Web\{
    WebControllerService,
    WebControllerServiceTrait,
    WebControllerTestService,
    WebControllerTestServiceTrait
};
use Gear\Module\ConstructService;
use Gear\Module\ConstructServiceTrait;
use Gear\Docker\DockerService;

/**
 * @group Module
 * @group ModuleService
 */
class ModuleServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();
        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->module->getModuleName()->willReturn('GearIt');

        $this->baseDir = (new Module)->getLocation();

        $this->templates = $this->baseDir.'/../test/template/module/script';

        $this->fileCreator    = $this->createFileCreator();

        $this->stringService  = new StringService();
        $this->dirService = new DirService();
        $this->fileService = new FileService();

        $this->composer = $this->prophesize(ComposerService::class);
        $this->testService = $this->prophesize(ModuleTestsService::class);

        $this->schema = $this->prophesize(SchemaService::class);

        $this->schemaLoader = $this->prophesize(SchemaLoaderService::class);

        $this->configService = $this->prophesize(ConfigService::class);

        $this->languageService = $this->prophesize(LanguageService::class);

        $this->viewService = $this->prophesize(ViewService::class);

        $this->gulpfile = $this->prophesize(Gulpfile::class);

        $this->package = $this->prophesize(Package::class);

        $this->karma = $this->prophesize(Karma::class);

        $this->protractor = $this->prophesize(Protractor::class);

        $this->docs = $this->prophesize(Docs::class);

        $this->dir = new DirService();

        $this->view = $this->prophesize(ViewService::class);

        $this->cache = $this->prophesize(CacheService::class);

        $this->request = $this->prophesize(Request::class);

        $this->applicationConfig = $this->prophesize(ApplicationConfig::class);

        $this->autoload = $this->prophesize(ComposerAutoload::class);

        $this->construct = $this->prophesize(ConstructService::class);

        $this->actionConstructor = $this->prophesize(ActionConstructor::class);
        $this->controllerConstructor = $this->prophesize(ControllerConstructor::class);

        $this->dockerService = $this->prophesize(DockerService::class);

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'GearProject',
                    'git' => 'git@pibernetwork.com/gear-project.git',
                ***REMOVED***
            ***REMOVED***

        ***REMOVED***;

        $this->gearConfig = $this->prophesize('Gear\Config\GearConfig');
    }

    public function getNamespaces()
    {

        return [
            ['MyNamespace', 'MyNamespace'***REMOVED***,
            ['MyBigNamespace', 'MyBigNamespace'***REMOVED***,
            ['MyBig\Namespace', 'MyBig\Namespace'***REMOVED***,
            ['MyBig', 'MyBig'***REMOVED***,
            ['My\Big', 'My\Big'***REMOVED***,

        ***REMOVED***;
    }

    /**
     * @dataProvider getNamespaces
     * @group namespaces
     */
    public function testModuleNamespace($data, $expected)
    {
        $this->module->getModuleName()->willReturn($data)->shouldBeCalled();
        $this->moduleService = $this->mockModuleRealCreator();
        $this->assertEquals($expected, $this->moduleService->getModuleNamespace());
    }

    /**
     * @group module1
     */
    public function testScriptDeploy()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService = $this->mockModuleRealCreator();

        $this->moduleService->getScriptDevelopment('cli');

        $expected = $this->templates.'/deploy-development-cli.sh';

        $this->assertEquals(
            file_get_contents(vfsStream::url('module/deploy-development.sh')),
            file_get_contents($expected)
        );
    }

    /**
     * @group script2
     */
    public function testScriptInstallStaging()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService = $this->mockModuleRealCreator();

        $this->moduleService->setStaging('gear-it.stag01.pibernetwork.com');
        $this->configService->getGit()->willReturn('git@bitbucket.org:mauriciopiber/gear-it.git')->shouldBeCalled();

        $this->moduleService->getInstallStagingScript();

        $expected = $this->templates.'/install-staging.sh';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/install-staging.sh'))
        );
    }

    /**
     * @group script2
     */
    public function testScriptDeployStaging()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService = $this->mockModuleRealCreator();

        $this->moduleService->setStaging('gear-it.stag01.pibernetwork.com');
        $this->moduleService->getStagingScript();

        $expected = $this->templates.'/deploy-staging.sh';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/deploy-staging.sh'))
        );
    }

    /**
     * @group gitignore
     */
    public function testGitIgnoreWeb()
    {
        $this->moduleService = $this->mockModuleRealCreator();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->moduleService->createGitIgnore('web');

        $expected = $this->templates.'/../gitignore-web';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/.gitignore'))
        );
    }

    /**
     * @group gitignore
     */
    public function testGitIgnoreCli()
    {
        $this->moduleService = $this->mockModuleRealCreator();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService->createGitIgnore('cli');

        $expected = $this->templates.'/../gitignore-cli';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/.gitignore'))
        );
    }

    public function prepareSchema($moduleName, $type = 'Action')
    {
        $this->schema->create($moduleName)->willReturn(true)->shouldBeCalled();
        $this->schemaLoader->loadSchema()->willReturn(true)->shouldBeCalled();

        $this->schemaController->create(
            $moduleName,
            ['name' => 'IndexController', 'services' => 'factories', 'type' => $type***REMOVED***
        )->willReturn(true)->shouldBeCalled();

        $this->schemaAction->create(
            $moduleName,
            ['controller' => 'IndexController', 'name' => 'Index'***REMOVED***,
            false
        )->willReturn(true)->shouldBeCalled();
    }

    public function prepareController()
    {
        $this->controllerTest->module()->shouldBeCalled();
        $this->controller->module()->shouldBeCalled();
        $this->controllerTest->moduleFactory()->shouldBeCalled();
        $this->controller->moduleFactory()->shouldBeCalled();
    }

    public function prepareConsoleController()
    {
        $this->consoleControllerTest->module()->shouldBeCalled();
        $this->consoleController->module()->shouldBeCalled();
        $this->consoleControllerTest->moduleFactory()->shouldBeCalled();
        $this->consoleController->moduleFactory()->shouldBeCalled();
    }

    public function prepareBaseModule($type)
    {
        $this->configService->module($type, null)->shouldBeCalled();

        $this->languageService->module()->shouldBeCalled();

        $this->appController->createIndexController()->shouldBeCalled();
        $this->appControllerSpec->createTestIndexAction()->shouldBeCalled();

        $this->viewService->createIndexView()->shouldBeCalled();
        $this->viewService->createErrorView()->shouldBeCalled();
        $this->viewService->createDeleteView()->shouldBeCalled();
        $this->viewService->create404View()->shouldBeCalled();
        $this->viewService->createLayoutSuccessView()->shouldBeCalled();
        $this->viewService->createLayoutDeleteSuccessView()->shouldBeCalled();
        $this->viewService->createLayoutDeleteFailView()->shouldBeCalled();
        $this->viewService->createBreadcrumbView()->shouldBeCalled();

        $this->karma->create()->shouldBeCalled();


        $this->protractor->create()->shouldBeCalled();
        $this->protractor->report()->shouldBeCalled();

        $this->package->create()->shouldBeCalled();


        $this->gulpfile->createFile()->shouldBeCalled();
        $this->gulpfile->createFileConfig()->shouldBeCalled();


        $this->docs->createConfig()->shouldBeCalled();
        $this->docs->createIndex()->shouldBeCalled();
        $this->docs->createReadme()->shouldBeCalled();
        $this->docs->createChangelog()->shouldBeCalled();
    }

    public function mockFilesInCreator($moduleSrc, $fileLocation)
    {
        $parser = new Parser();

        $files = $parser->parse(file_get_contents($fileLocation));

        if (!isset($files) || !isset($files['files'***REMOVED***) || count($files['files'***REMOVED***) <= 0) {
            throw new \Exception('Missing Files');
        }

        foreach ($files['files'***REMOVED*** as $file) {
            $this->fileCreator->setTemplate($file['template'***REMOVED***)->shouldBeCalled();
            if (isset($file['options'***REMOVED***)) {
                $this->fileCreator->setOptions($file['options'***REMOVED***)->shouldBeCalled();
            } else {
                $this->fileCreator->setOptions([***REMOVED***)->shouldBeCalled();
            }

            if (isset($file['location'***REMOVED***)) {
                $this->fileCreator->setLocation(
                    vfsStream::url(sprintf('%s/%s', $moduleSrc, $file['location'***REMOVED***))
                )->shouldBeCalled();
            } else {
                $this->fileCreator->setLocation(
                    vfsStream::url(sprintf($moduleSrc))
                )->shouldBeCalled();
            }

            $this->fileCreator->setFileName($file['filename'***REMOVED***)->shouldBeCalled();
            $this->fileCreator->render()->shouldBeCalled();
        }
    }

    public function moduleAsProject()
    {
        return [
            ['web'***REMOVED***,
            ['cli'***REMOVED***,
            //['api'***REMOVED***,
            //['src'***REMOVED***,
            //['src-zf2'***REMOVED***,
            //['src-zf3'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider moduleAsProject
     * @group xxx
     */
    public function testCreateModuleAsProject($type)
    {
        $moduleName = sprintf('%sModule', ucfirst($type));
        $location = vfsStream::url('module');

        $this->module = new \Gear\Module\Structure\ModuleStructure(
            $this->stringService,
            $this->dirService,
            $this->fileService
        );
        $this->module->setRequestName($moduleName);

        $files = sprintf(__DIR__.'/_files/module-%s.yml', $type);
        $this->assertFileExists($files);

        $controllerConstructor = [
            ModuleTypesInterface::WEB,
            ModuleTypesInterface::CLI,
            ModuleTypesInterface::API
        ***REMOVED***;
        if (in_array($type, $controllerConstructor)) {
            $this->controllerConstructor->createModule($type)->shouldBeCalled();
        }

        if ($type === ModuleTypesInterface::WEB) {
            $this->actionConstructor->createModule($type)->shouldBeCalled();
        }

        $this->moduleService = $this->mockModuleFakeCreator();

        $this->mockFilesInCreator(sprintf('module/%s-module', $type), $files);

        $created = $this->moduleService->moduleAsProject($moduleName, $location, $type);
        $this->assertTrue($created);
    }


    public function mockModuleFakeCreator()
    {
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
        return $this->mockModule($this->fileCreator->reveal());
    }

    public function mockModuleRealCreator()
    {
        $this->fileCreator    = $this->createFileCreator();

        return $this->mockModule($this->fileCreator);
    }

    public function mockModule($fileCreator)
    {
        return new ModuleService(
            $fileCreator,
            $this->stringService,
            ($this->module instanceof \Prophecy\Prophecy\ObjectProphecy) ? $this->module->reveal() : $this->module,
            $this->docs->reveal(),
            $this->composer->reveal(),
            $this->testService->reveal(),
            $this->karma->reveal(),
            $this->protractor->reveal(),
            $this->package->reveal(),
            $this->gulpfile->reveal(),
            $this->languageService->reveal(),
            $this->schema->reveal(),
            $this->schemaLoader->reveal(),
            $this->configService->reveal(),
            $this->viewService->reveal(),
            $this->request->reveal(),
            $this->cache->reveal(),
            $this->applicationConfig->reveal(),
            $this->autoload->reveal(),
            $this->config,
            $this->dir,
            $this->gearConfig->reveal(),
            $this->controllerConstructor->reveal(),
            $this->actionConstructor->reveal(),
            $this->dockerService->reveal()
        );
    }
}
