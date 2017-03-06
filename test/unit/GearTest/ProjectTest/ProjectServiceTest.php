<?php
namespace GearTest\ProjectTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Gear\Project\Config\Globally;
use Gear\Project\Config\Local;
use Gear\Creator\TemplateService;
use GearBase\Util\File\FileService;
use Gear\Creator\File;
use GearBase\Util\String\StringService;
use Gear\Project\Docs\Docs;
use Gear\Project\ProjectService;

/**
 * @group Project
 * @group ProjectService
 */
class ProjectServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->projectDir = vfsStream::setUp('project');

        $template       = new TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $this->fileService    = new FileService();
        $this->fileCreator    = new File($this->fileService, $template);

        $this->string = new StringService();

        $this->templates = (new \Gear\Module())->getLocation().'/../../test/template/project/config/autoload';

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/project';

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'MyProject',
                    'host' => 'my-project.gear.dev',
                    'git' => 'git@bitbucket.org:mauriciopiber/my-project.git'
                ***REMOVED***
            ***REMOVED***,
            'doctrine' => [
                'connection' => [
                    'orm_default' => [
                        'params' => [
                            'dbname' => 'my_db',
                            'username' => 'my_username',
                            'password' => 'my_password'
                        ***REMOVED***
                    ***REMOVED***
                ***REMOVED***,
            ***REMOVED***
        ***REMOVED***;

        $this->docsReal = new Docs(
            $this->config,
            $this->string,
            $this->fileCreator

        );

        $this->file = $this->prophesize('GearBase\Util\File\FileService');

        $this->gearConfig = $this->prophesize('GearBase\Config\GearConfig');
        $this->dirService = $this->prophesize('GearBase\Util\Dir\DirService');
        $this->edge = $this->prophesize('Gear\Edge\DirEdge');
        $this->docs = $this->prophesize('Gear\Project\Docs\Docs');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
        $this->antUpgrade = $this->prophesize('Gear\Upgrade\AntUpgrade');
        $this->npmUpgrade = $this->prophesize('Gear\Upgrade\NpmUpgrade');
        $this->composerService = $this->prophesize('Gear\Project\Composer\ComposerService');
        $this->fileService = $this->prophesize('GearBase\Util\File\FileService');

        $this->project = new ProjectService(
            $this->gearConfig->reveal(),
            $this->dirService->reveal(),
            $this->fileService->reveal(),
            $this->fileCreator,
            $this->edge->reveal(),
            $this->docsReal,
            $this->consolePrompt->reveal(),
            $this->antUpgrade->reveal(),
            $this->npmUpgrade->reveal(),
            $this->config,
            $this->composerService->reveal()
            /*
             use GearConfigTrait;

             use DocsTrait;

             use DirEdgeTrait;

             use AntUpgradeTrait;

             use NpmUpgradeTrait;

             use ComposerServiceTrait;

             use VersionServiceTrait;

             use ScriptServiceTrait;
             */

        );

        //$this->project->setProject($this->projectDir);
    }

    /**
     * @group stag1

    public function testCreateStaging()
    {
        vfsStream::newDirectory('script')->at($this->projectDir);

        $this->project = new ProjectService();

        $file = $this->project->getScriptStaging();

        $this->assertEquals(
            file_get_contents(sprintf($this->template.'/script/deploy-staging.phtml', $template)),
            file_get_contents($file)
        );
    }
     */

    public function scriptData()
    {
        return [
            ['getJenkinsfile', 'Jenkinsfile'***REMOVED***,
            ['getScriptLoad', 'script/load'***REMOVED***,
            ['getScriptDevelopment', 'script/deploy-development'***REMOVED***,
            ['getScriptStaging', 'script/deploy-staging'***REMOVED***,
            ['getScriptProduction', 'script/deploy-production'***REMOVED***,
            ['getScriptInstallStaging', 'script/install-staging'***REMOVED***,
            ['getScriptInstallProduction', 'script/install-production'***REMOVED***,
            ['getScriptTesting', 'script/deploy-testing'***REMOVED***,
            ['getGulpfileJs', 'gulpfile.js'***REMOVED***,
            ['getGulpfileConfig', 'data/config.json'***REMOVED***,
            ['getConfigDocs', 'mkdocs.yml'***REMOVED***,
            ['getIndexDocs', 'docs/index.md'***REMOVED***,
            ['getReadme', 'README.md'***REMOVED***,
            ['getCodeception', 'codeception.yml'***REMOVED***,
            ['getProtractorConfig', 'end2end.conf.js'***REMOVED***,
            ['getProtractorReportConfig', 'data/report.js'***REMOVED***,
            ['getKarmaConfig', 'karma.conf.js'***REMOVED***,
            ['getPhpDoxConfig', 'phpdox.xml'***REMOVED***,
            ['getPhinxConfig', 'phinx.yml'***REMOVED***,
            ['copyPHPMD', 'phpmd.xml'***REMOVED***,
            ['getPhpcsDocs', 'phpcs-docs.xml'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @group Script
     * @dataProvider scriptData
     */
    public function testCreateScript($method, $template)
    {
        vfsStream::newDirectory('script')->at($this->projectDir);
        vfsStream::newDirectory('data')->at($this->projectDir);

        $this->gearConfig->getCurrentName()->willReturn('MyProject');
        $this->gearConfig->getCurrentGit()->willReturn('git@bitbucket.org:mauriciopiber/my-project.git');
        $this->gearConfig->getCurrentDevelopment()->willReturn('my-project.gear.dev');
        $this->gearConfig->getCurrentStaging()->willReturn('my-project.stag01.pibernetwork.com');
        $this->gearConfig->getCurrentProduction()->willReturn('my-project.pibernetwork.com');

        //$this->project->setStaging('my-project.stag01.pibernetwork.com');
        //$this->project->setProduction('my-project.pibernetwork.com');
        $this->project->setConfig($this->config);
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project'));
        $this->project->setFileService($this->file->reveal());
        $this->project->setGearConfig($this->gearConfig->reveal());

        $this->project->setStringService($this->string);

        $file = $this->project->{$method}();


        $this->assertEquals(
            file_get_contents(sprintf($this->template.'/%s.phtml', $template)),
            file_get_contents($file)
        );
    }

    /**
     * @group con13
     */
    public function testSetUpConfig()
    {
        $username = 'my-username';
        $password = 'my-password';
        $dbname = 'database_for_development';
        $host = 'gear-project.gear.com';
        $environment = 'development';


        $root = vfsStream::setup('project');
        $this->assertFileExists(vfsStream::url('project'));

        $project = vfsStream::newDirectory('GearProject')->at($root);
        $this->assertFileExists(vfsStream::url('project/GearProject'));

        $config = vfsStream::newDirectory('config')->at($project);
        $this->assertFileExists(vfsStream::url('project/GearProject/config'));

        $autoload = vfsStream::newDirectory('autoload')->at($config);
        $this->assertFileExists(vfsStream::url('project/GearProject/config/autoload'));
        //vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        $this->createMockGlobal();

        vfsStream::newDirectory('public')->at($project);

        $this->assertFileExists(vfsStream::url('project/GearProject/config/autoload'));
        $this->assertFileExists(vfsStream::url('project/GearProject/config/autoload/global.php'));
        $this->assertFileExists(vfsStream::url('project/GearProject/public'));
        /*
        vfsStream::newDirectory('GearProject')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('GearProject/config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('GearProject/config/autoload')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('GearProject/public')->at(vfsStreamWrapper::getRoot());
*/

        $this->gearConfig->getCurrentDevelopment()->willReturn('gear-project.gear.dev');
        $this->gearConfig->getCurrentTesting()->willReturn('gear-project.gear.com');
        $this->gearConfig->getCurrentStaging()->willReturn('gear-project.stag55.pibernetwork.com');
        $this->gearConfig->getCurrentProduction()->willReturn('gear-project.pibernetwork.com');

        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project/GearProject'));
        $this->project->setGearConfig($this->gearConfig->reveal());

    //    $this->createMockGlobal();

        $result = $this->project->setUpConfig($dbname, $username, $password, $host, $environment);

        $this->assertTrue($result);

        $expected = $this->templates.'/local.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/config/autoload/local.php'))
        );

        $expected = $this->templates.'/global.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/config/autoload/global.php'))
        );

        /*
        $expected = $this->templates.'/global.development.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/config/autoload/global.development.php'))
        );
        */

        $this->assertEquals(
            file_get_contents($this->templates.'/htaccess.phtml'),
            file_get_contents(vfsStream::url('project/GearProject/public/.htaccess'))
        );
    }


    /**
     * @group con12
     */
    public function testSetUpEnvironment()
    {
        $environment = 'development';

        vfsStream::newDirectory('GearProject')->at(vfsStreamWrapper::getRoot());

        vfsStream::newDirectory('GearProject/public')->at(vfsStreamWrapper::getRoot());

        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project/GearProject'));

        $result = $this->project->setUpEnvironment($environment);

        $this->assertTrue($result);

        $expected = $this->templates.'/htaccess.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/public/.htaccess'))
        );
    }

    /**
     * @group con1
     */
    public function testSetUpLocal()
    {
        $username = 'my-username';
        $password = 'my-password';

        vfsStream::newDirectory('GearProject')->at(vfsStreamWrapper::getRoot());

        vfsStream::newDirectory('GearProject/config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('GearProject/config/autoload')->at(vfsStreamWrapper::getRoot());
        //vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project/GearProject'));

        $result = $this->project->setUpLocal($username, $password);

        $this->assertTrue($result);

        $expected = $this->templates.'/local.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/config/autoload/local.php'))
        );
    }

    public function createMockGlobal()
    {
        file_put_contents(vfsStream::url('project/GearProject/config/autoload/global.php'), <<<EOS
<?php return [
            'gear' => [
                'project' => [
                    'name' => 'GearProject',
                    'git' => 'git@bitbucket.org:mauriciopiber/gear-project.git',
                    'version' => '0.1.0',
                    'label' => 'Gear Project'
                 ***REMOVED***
            ***REMOVED***,
            'bjyauthorize' => ['acl_key' => 'gear_project'***REMOVED***,
            'admin' => [
                'name' => 'Gear Project',
                'title' => 'Admin Gear Project',
                'welcome' => 'Bem vindo ao Gear Project'
            ***REMOVED***
         ***REMOVED***;
EOS
            );
    }
    /**
     * @group con13
     */
    public function testSetUpGlobal()
    {
        $dbname = 'database_for_development';
        $host = 'gear-project.gear.com';
        $environment = 'development';



        vfsStream::newDirectory('GearProject')->at(vfsStreamWrapper::getRoot());

        vfsStream::newDirectory('GearProject/config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('GearProject/config/autoload')->at(vfsStreamWrapper::getRoot());
        //vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        $this->createMockGlobal();

        $this->gearConfig->getCurrentDevelopment()->willReturn('gear-project.gear.dev');
        $this->gearConfig->getCurrentTesting()->willReturn('gear-project.gear.com');
        $this->gearConfig->getCurrentStaging()->willReturn('gear-project.stag55.pibernetwork.com');
        $this->gearConfig->getCurrentProduction()->willReturn('gear-project.pibernetwork.com');

        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project/GearProject'));
        $this->project->setGearConfig($this->gearConfig->reveal());

        $result = $this->project->setUpGlobal($dbname, $host, $environment);

        $this->assertTrue($result);

        $expected = $this->templates.'/global.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/config/autoload/global.php'))
        );

        /**
        $expected = $this->templates.'/global.development.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/config/autoload/global.development.php'))
        );
        */
    }

    public function projects()
    {
        return [
            [
                'GearProject',
                'gear-project.gear.dev',
                'git@bitbucket.org:mauriciopiber/gear-project.git',
                'gear_project',
                'root',
                'password',
                true
           ***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider projects
     * @group pro1
     */
    public function testCreateProject($name, $host, $git, $database, $user, $pass, $nfs)
    {
        $root = vfsStream::setup('project');

        $project = vfsStream::newDirectory('GearProject')->at($root);

        $config = vfsStream::newDirectory('config')->at($project);
        vfsStream::newDirectory('autoload')->at($config);


        vfsStream::newDirectory('public')->at($project);

        vfsStream::newDirectory('data')->at($project);
        vfsStream::newDirectory('script')->at($project);

        $this->assertFileExists(vfsStream::url('project/GearProject/config/autoload'));
        $this->assertFileExists(vfsStream::url('project/GearProject/public'));


        $request = $this->prophesize('Zend\Console\Request');
        $request->getParam('type', 'web')->willReturn('web');
        $request->getParam('staging', null)->willReturn('staging.com.br');
        $request->getParam('production', null)->willReturn('production.com.br');
        $request->getParam('basepath', null)->willReturn(vfsStream::url('project'));
        $request->getParam('project', null)->willReturn($name);
        $request->getParam('host', null)->willReturn($host);
        $request->getParam('git', null)->willReturn($git);
        $request->getParam('database', null)->willReturn($database);
        $request->getParam('username', 'root')->willReturn($user);
        $request->getParam('password', 'gear')->willReturn($pass);
        $request->getParam('nfs', null)->willReturn($nfs);





        $project = new \Gear\Project\Project(array(
            'project'  => $name,
            'host'     => $host,
            'git'      => $git,
            'database' => $database,
            'username' => $user,
            'password' => $pass,
            'nfs'      => $nfs,
            'type'     => 'web',
            'folder'   => vfsStream::url('project')
        ));


        $global = new Globally(array(
            'dbms' => 'mysql',
            'dbname' => $database,
            'dbhost' => 'localhost'
        ));

        $local = new Local(array(
            'username' => $user,
            'password' => $pass,
            'host'     => $host,
            'environment' => 'development'
        ));

        $this->composerService->createComposer($project)->willReturn(true)->shouldBeCalled();
        //$this->composerService->runComposerUpdate($project)->willReturn(true)->shouldBeCalled();


        $this->script = $this->prophesize('Gear\Script\ScriptService');

        $this->script->setLocation('vfs://project')->willReturn(true)->shouldBeCalled();
        $this->script->setLocation('vfs://project/GearProject')->willReturn(true)->shouldBeCalled();
        //$this->script->setLocation(null)->willReturn(true)->shouldBeCalled();

        $basePath = \GearBase\Module::getProjectFolder();

        $cmd = $basePath.'/bin/installer-utils/clone-skeleton vfs://project vfs://project/GearProject GearProject';
        $this->script->run($cmd)->willReturn(true)->shouldBeCalled();

        /*
        $cmd = $basePath.'/bin/nfs vfs://project/GearProject';
        $this->script->run($cmd)->willReturn(true)->shouldBeCalled();

        $cmd = $basePath.'/bin/git vfs://project/GearProject git@bitbucket.org:mauriciopiber/gear-project.git';
        $this->script->run($cmd)->willReturn(true)->shouldBeCalled();
        */

        $this->fileService->chmod(0777, 'vfs://project/GearProject/phpmd.xml')->willReturn(true)->shouldBeCalled();
        $this->fileService->chmod(0777, 'vfs://project/GearProject/phpdox.xml')->willReturn(true)->shouldBeCalled();
        $this->fileService->chmod(0777, 'vfs://project/GearProject/build.xml')->willReturn(true)->shouldBeCalled();
        $this->fileService->chmod(0777, 'vfs://project/GearProject/codeception.yml')->willReturn(true)->shouldBeCalled();
        $this->fileService->chmod(0777, 'vfs://project/GearProject/package.json')->willReturn(true)->shouldBeCalled();

        $this->edge->getDirProject('web')->willReturn([
            'writable' => [***REMOVED***,
            'ignore' => [***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->docs = $this->prophesize('Gear\Project\Docs\Docs');

        $this->docs->createReadme('GearProject', "vfs://project/GearProject")->shouldBeCalled();
        $this->docs->createConfig('GearProject', "vfs://project/GearProject")->shouldBeCalled();
        $this->docs->createIndex('GearProject', "vfs://project/GearProject")->shouldBeCalled();
        $this->docs->createChangelog('GearProject', "vfs://project/GearProject")->shouldBeCalled();

        $this->antUpgrade->getConsolePrompt()->willReturn($this->consolePrompt->reveal())->shouldBeCalled();
        $this->antUpgrade->setProject('vfs://project/GearProject')->shouldBeCalled();
        $this->antUpgrade->upgradeProject('web')->willReturn(true)->shouldBeCalled();

        $this->npmUpgrade->getConsolePrompt()->willReturn($this->consolePrompt->reveal())->shouldBeCalled();

        $this->npmUpgrade->setProject('vfs://project/GearProject')->shouldBeCalled();
        $this->npmUpgrade->upgradeProject('web')->willReturn(true)->shouldBeCalled();

        $this->project->setAntUpgrade($this->antUpgrade->reveal());
        $this->project->setNpmUpgrade($this->npmUpgrade->reveal());

        $this->project->setRequest($request->reveal());
        $this->project->setStringService($this->string);
        $this->project->setScriptService($this->script->reveal());

        //$this->project->setConfigService($this->config->reveal());
        $this->project->setDirService($this->dirService->reveal());
        $this->project->setFileService($this->fileService->reveal());
        $this->project->setDocs($this->docs->reveal());



        $result = $this->project->create('web');
        $this->assertTrue($result);

        /**
        $expected = $this->templates.'/global.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/config/autoload/global.php'))
        );

        $expected = $this->templates.'/global.development.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/GearProject/config/autoload/global.development.php'))
        );
        **/
    }

    public function testCreateIndexFile()
    {
        $this->project->setFileCreator($this->fileCreator);

        vfsStream::newDirectory('public')->at(vfsStreamWrapper::getRoot());

        $file = $this->project->createIndexFile(vfsStream::url('project'));

        $expected = (new \Gear\Module())->getLocation().'/../../test/template/project/public/index.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }

    public function testCreateApplicationConfigFile()
    {
        $this->project->setFileCreator($this->fileCreator);

        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());

        $file = $this->project->createApplicationConfigFile(vfsStream::url('project'));

        $expected = (new \Gear\Module())->getLocation().'/../../test/template/project/config/application.config.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }

    /**
     * @group phinx
     */
    public function testCreatePhinxFile()
    {
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setConfig($this->config);


        $file = $this->project->getPhinxConfig();

        $expected = (new \Gear\Module())->getLocation().'/../../test/template/project/phinx.yml.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }

    /**
     * @group cre1
     */
    public function testCreateDir()
    {
        $this->project->setFileCreator($this->fileCreator);

        $this->edge = $this->prophesize('Gear\Edge\DirEdge');
        $this->edge->getDirProject('web')->willReturn([
            'writable' => [
                'node_modules',
                'script',
                'data/logs',
                'data/cache/configcache',
                'public/upload',
                'data/DoctrineModule/cache',
                'data/DoctrineORMModule/Proxy',
             ***REMOVED***,
            'ignore' => [
                'node_modules',
                'data/DoctrineORMModule/Proxy',
                'data/DoctrineModule/cache',
                'data/logs',
                'data/cache/configcache'
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->project->setDirEdge($this->edge->reveal());

        $this->project->setDirService(new \GearBase\Util\Dir\DirService());


        vfsStream::newDirectory('GearProject')->at(vfsStreamWrapper::getRoot());

        $file = $this->project->createDir(vfsStream::url('project/GearProject'));
        $this->assertTrue($file);


        $this->assertFileExists(vfsStream::url('project/GearProject/node_modules'));
        $this->assertFileExists(vfsStream::url('project/GearProject/node_modules/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/GearProject/script'));
        $this->assertFileExists(vfsStream::url('project/GearProject/data/logs'));
        $this->assertFileExists(vfsStream::url('project/GearProject/data/logs/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/GearProject/data/cache/configcache'));
        $this->assertFileExists(vfsStream::url('project/GearProject/data/cache/configcache/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/GearProject/data/DoctrineModule/cache'));
        $this->assertFileExists(vfsStream::url('project/GearProject/data/DoctrineModule/cache/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/GearProject/data/DoctrineORMModule/Proxy'));
        $this->assertFileExists(vfsStream::url('project/GearProject/data/DoctrineORMModule/Proxy/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/GearProject/public/upload'));


    }

}
