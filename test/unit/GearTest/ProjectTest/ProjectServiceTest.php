<?php
namespace GearTest\ProjectTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

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

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->string = new \GearBase\Util\String\StringService();

        $this->templates = (new \Gear\Module())->getLocation().'/../../test/template/project/config/autoload';

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/project';

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'MyProject',
                    'host' => 'my-project.gear.dev'
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

        $this->docs = new \Gear\Project\Docs\Docs(
            $this->config,
            $this->string,
            $this->fileCreator

        );

        $this->file = $this->prophesize('GearBase\Util\File\FileService');
        //$this->docs->setStringService($this->string);
        //$this->docs->setFileCreator($this->fileCreator);


    }

    public function scriptData()
    {
        return [
            ['getScriptDevelopment', 'script/deploy-development'***REMOVED***,
            ['getScriptStaging', 'script/deploy-staging'***REMOVED***,
            ['getScriptProduction', 'script/deploy-production'***REMOVED***,
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
            ['getPhpcsDocs', 'phpcs-docs.xml'***REMOVED***

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


        $this->project = new \Gear\Project\ProjectService();
        $this->project->setConfig($this->config);
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project'));
        $this->project->setFileService($this->file->reveal());

        $this->project->setStringService($this->string);
        $this->project->setDocs($this->docs);

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
        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project/GearProject'));

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

        $this->project = new \Gear\Project\ProjectService();
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

        $this->project = new \Gear\Project\ProjectService();
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



        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project/GearProject'));

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

        $this->assertFileExists(vfsStream::url('project/GearProject/config/autoload'));
        $this->assertFileExists(vfsStream::url('project/GearProject/public'));


        $request = $this->prophesize('Zend\Console\Request');
        $request->getParam('type', 'web')->willReturn('web');
        $request->getParam('basepath', null)->willReturn(vfsStream::url('project'));
        $request->getParam('project', null)->willReturn($name);
        $request->getParam('host', null)->willReturn($host);
        $request->getParam('git', null)->willReturn($git);
        $request->getParam('database', null)->willReturn($database);
        $request->getParam('username', null)->willReturn($user);
        $request->getParam('password', null)->willReturn($pass);
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


        $global = new \Gear\Project\Config\Globally(array(
            'dbms' => 'mysql',
            'dbname' => $database,
            'dbhost' => 'localhost'
        ));

        $local = new \Gear\Project\Config\Local(array(
            'username' => $user,
            'password' => $pass,
            'host'     => $host,
            'environment' => 'development'
        ));



        //$request->getParam('project', null)->willReturn('GearProject');

        $fileCreator = $this->prophesize('Gear\Creator\File');


        $composerService = $this->prophesize('Gear\Project\Composer\ComposerService');
        $composerService->createComposer($project)->willReturn(true)->shouldBeCalled();
        //$composerService->runComposerUpdate($project)->willReturn(true)->shouldBeCalled();


        $script = $this->prophesize('Gear\Script\ScriptService');

        $script->setLocation('vfs://project')->willReturn(true)->shouldBeCalled();
        $script->setLocation('vfs://project/GearProject')->willReturn(true)->shouldBeCalled();
        //$script->setLocation(null)->willReturn(true)->shouldBeCalled();



        $cmd = '/var/www/gear-package/gear/bin/installer-utils/clone-skeleton vfs://project vfs://project/GearProject GearProject';
        $script->run($cmd)->willReturn(true)->shouldBeCalled();


        /*
        $cmd = '/var/www/gear-package/gear/bin/installer '
             . '"/var/www/gear-package/gear/bin" "" "GearProject" '
             . '"/GearProject" "gear-project.gear.dev" '
             . '"git@bitbucket.org:mauriciopiber/gear-project.git" '
             . '"gear_project" "root" "password" "gear-project"';

        $script->run($cmd)->willReturn(true)->shouldBeCalled();

        $cmd = '/var/www/gear-package/gear/bin/installer-utils/run-gear.sh /GearProject';
        $script->run($cmd)->willReturn(true)->shouldBeCalled();


        $cmd = '/var/www/gear-package/gear/bin/virtualhost /GearProject gear-project.gear.dev development';
        $script->run($cmd)->willReturn(true)->shouldBeCalled();
*/
        $cmd = '/var/www/gear-package/gear/bin/nfs vfs://project/GearProject';
        $script->run($cmd)->willReturn(true)->shouldBeCalled();


        $cmd = '/var/www/gear-package/gear/bin/git vfs://project/GearProject git@bitbucket.org:mauriciopiber/gear-project.git';
        $script->run($cmd)->willReturn(true)->shouldBeCalled();

        $dirService = $this->prophesize('GearBase\Util\Dir\DirService');


        $fileService = $this->prophesize('GearBase\Util\File\FileService');
        $fileService->chmod(0777, 'vfs://project/GearProject/phpmd.xml')->willReturn(true)->shouldBeCalled();
        $fileService->chmod(0777, 'vfs://project/GearProject/phpdox.xml')->willReturn(true)->shouldBeCalled();
        $fileService->chmod(0777, 'vfs://project/GearProject/build.xml')->willReturn(true)->shouldBeCalled();
        $fileService->chmod(0777, 'vfs://project/GearProject/codeception.yml')->willReturn(true)->shouldBeCalled();
        $fileService->chmod(0777, 'vfs://project/GearProject/package.json')->willReturn(true)->shouldBeCalled();

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirProject('web')->willReturn([
            'writable' => [***REMOVED***,
            'ignore' => [***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->docs = $this->prophesize('Gear\Project\Docs\Docs');
        $this->docs->createReadme('GearProject', "vfs://project/GearProject")->shouldBeCalled();
        $this->docs->createConfig('GearProject', "vfs://project/GearProject")->shouldBeCalled();
        $this->docs->createIndex('GearProject', "vfs://project/GearProject")->shouldBeCalled();


        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->antUpgrade = $this->prophesize('Gear\Upgrade\AntUpgrade');
        $this->antUpgrade->getConsolePrompt()->willReturn($this->consolePrompt->reveal())->shouldBeCalled();
        $this->antUpgrade->setProject('vfs://project/GearProject')->shouldBeCalled();
        $this->antUpgrade->upgradeProject('web')->willReturn(true)->shouldBeCalled();




        $this->npmUpgrade = $this->prophesize('Gear\Upgrade\NpmUpgrade');
        $this->npmUpgrade->getConsolePrompt()->willReturn($this->consolePrompt->reveal())->shouldBeCalled();

        $this->npmUpgrade->setProject('vfs://project/GearProject')->shouldBeCalled();
        $this->npmUpgrade->upgradeProject('web')->willReturn(true)->shouldBeCalled();

        $this->project = new \Gear\Project\ProjectService();
        $this->project->setAntUpgrade($this->antUpgrade->reveal());
        $this->project->setNpmUpgrade($this->npmUpgrade->reveal());
        $this->project->setDocs($this->docs->reveal());
        $this->project->setDirEdge($edge->reveal());
        $this->project->setFileCreator($fileCreator->reveal());
        $this->project->setRequest($request->reveal());
        $this->project->setStringService($this->string);
        $this->project->setScriptService($script->reveal());

        //$this->project->setConfigService($this->config->reveal());
        $this->project->setDirService($dirService->reveal());
        $this->project->setFileService($fileService->reveal());
        $this->project->setComposerService($composerService->reveal());

        $result = $this->project->create();
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
        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($this->fileCreator);

        vfsStream::newDirectory('public')->at(vfsStreamWrapper::getRoot());

        $file = $this->project->createIndexFile(vfsStream::url('project'));

        $expected = (new \Gear\Module())->getLocation().'/../../test/template/project/public/index.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }

    public function testCreateApplicationConfigFile()
    {
        $this->project = new \Gear\Project\ProjectService();
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
        $this->project = new \Gear\Project\ProjectService();
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
        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($this->fileCreator);

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirProject('web')->willReturn([
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

        $this->project->setDirEdge($edge->reveal());

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
