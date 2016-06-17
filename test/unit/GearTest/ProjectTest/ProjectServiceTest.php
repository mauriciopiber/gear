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
        vfsStream::setUp('project');

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->string = new \GearBase\Util\String\StringService();

        $this->templates = (new \Gear\Module())->getLocation().'/../../test/template/project/config/autoload';

        $this->templateScript = (new \Gear\Module())->getLocation().'/../../test/template/project/script';
    }

    public function scriptData()
    {
        return [
            ['getScriptDevelopment', 'deploy-development'***REMOVED***,
            //['getScriptStaging', 'deploy-staging'***REMOVED***,
            //['getScriptProduction', 'deploy-production'***REMOVED***,
            //['getScriptTesting', 'deploy-testing'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @group Script
     * @dataProvider scriptData
     */
    public function testCreateScript($method, $template)
    {
        vfsStream::newDirectory('script')->at(vfsStreamWrapper::getRoot());

        $config = [
            'gear' => [
                'project' => [
                    'name' => 'MyProject'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $this->project = new \Gear\Project\ProjectService();
        $this->project->setConfig($config);
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project'));
        $this->project->setStringService($this->string);

        $file = $this->project->{$method}();


        $this->assertEquals(
            file_get_contents(sprintf($this->templateScript.'/%s.phtml', $template)),
            file_get_contents($file)
        );
    }

    /**
     * @group con1
     */
    public function testSetUpConfig()
    {
        $username = 'my-username';
        $password = 'my-password';
        $dbname = 'database_for_development';
        $host = 'websitefordevelopment.com';
        $environment = 'development';


        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/autoload')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public')->at(vfsStreamWrapper::getRoot());

        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project'));

        $result = $this->project->setUpConfig($dbname, $username, $password, $host, $environment);

        $this->assertTrue($result);

        $expected = $this->templates.'/local.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/config/autoload/local.php'))
        );

        $expected = $this->templates.'/global.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/config/autoload/global.php'))
        );

        $expected = $this->templates.'/global.development.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/config/autoload/global.development.php'))
        );

        $this->assertEquals(
            file_get_contents($this->templates.'/htaccess.phtml'),
            file_get_contents(vfsStream::url('project/public/.htaccess'))
        );
    }


    /**
     * @group con12
     */
    public function testSetUpEnvironment()
    {
        $environment = 'development';

        vfsStream::newDirectory('public')->at(vfsStreamWrapper::getRoot());

        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project'));

        $result = $this->project->setUpEnvironment($environment);

        $this->assertTrue($result);

        $expected = $this->templates.'/htaccess.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/public/.htaccess'))
        );
    }

    /**
     * @group con1
     */
    public function testSetUpLocal()
    {
        $username = 'my-username';
        $password = 'my-password';

        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/autoload')->at(vfsStreamWrapper::getRoot());
        //vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project'));

        $result = $this->project->setUpLocal($username, $password);

        $this->assertTrue($result);

        $expected = $this->templates.'/local.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/config/autoload/local.php'))
        );
    }

    /**
     * @group con1
     */
    public function testSetUpGlobal()
    {
        $dbname = 'database_for_development';
        $host = 'websitefordevelopment.com';
        $environment = 'development';

        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/autoload')->at(vfsStreamWrapper::getRoot());
        //vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($this->fileCreator);
        $this->project->setProject(vfsStream::url('project'));

        $result = $this->project->setUpGlobal($dbname, $host, $environment);

        $this->assertTrue($result);

        $expected = $this->templates.'/global.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/config/autoload/global.php'))
        );

        $expected = $this->templates.'/global.development.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('project/config/autoload/global.development.php'))
        );
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
            'type'     => 'web'
        //    'folder'   => vfsStream::url('project')
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

        $script->setLocation('/GearProject')->willReturn(true)->shouldBeCalled();
        $script->setLocation(null)->willReturn(true)->shouldBeCalled();

        $cmd = '/var/www/gear-package/gear/bin/installer-utils/clone-skeleton  /GearProject GearProject';
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
        $cmd = '/var/www/gear-package/gear/bin/nfs /GearProject';
        $script->run($cmd)->willReturn(true)->shouldBeCalled();


        $cmd = '/var/www/gear-package/gear/bin/git /GearProject git@bitbucket.org:mauriciopiber/gear-project.git';
        $script->run($cmd)->willReturn(true)->shouldBeCalled();

        $dirService = $this->prophesize('GearBase\Util\Dir\DirService');
        $dirService->mkDir('/GearProject/config/jenkins')->willReturn(true)->shouldBeCalled();

        $fileService = $this->prophesize('GearBase\Util\File\FileService');
        $fileService->chmod(0777, '/GearProject/config/jenkins/phpmd.xml')->willReturn(true)->shouldBeCalled();
        $fileService->chmod(0777, '/GearProject/phpdox.xml')->willReturn(true)->shouldBeCalled();
        $fileService->chmod(0777, '/GearProject/build.xml')->willReturn(true)->shouldBeCalled();
        $fileService->chmod(0777, '/GearProject/codeception.yml')->willReturn(true)->shouldBeCalled();
        $fileService->chmod(0777, '/GearProject/package.json')->willReturn(true)->shouldBeCalled();

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirProject('web')->willReturn([
            'writable' => [***REMOVED***,
            'ignore' => [***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->docs = $this->prophesize('Gear\Project\Docs\Docs');
        $this->docs->createReadme("/GearProject")->shouldBeCalled();
        $this->docs->createConfig("/GearProject")->shouldBeCalled();
        $this->docs->createIndex("/GearProject")->shouldBeCalled();


        $this->antUpgrade = $this->prophesize('Gear\Upgrade\AntUpgrade');
        $this->antUpgrade->setProject('/GearProject')->shouldBeCalled();
        $this->antUpgrade->upgradeProject('web')->willReturn(true)->shouldBeCalled();

        $this->npmUpgrade = $this->prophesize('Gear\Upgrade\NpmUpgrade');
        $this->npmUpgrade->setProject('/GearProject')->shouldBeCalled();
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

        $file = $this->project->getPhinxConfig(
            vfsStream::url('project'),
            'my_database',
            'my_username',
            'my_password'
        );

        $expected = (new \Gear\Module())->getLocation().'/../../test/template/project/phinx.phtml';

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

        $file = $this->project->createDir(vfsStream::url('project'));
        $this->assertTrue($file);


        $this->assertFileExists(vfsStream::url('project/node_modules'));
        $this->assertFileExists(vfsStream::url('project/node_modules/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/script'));
        $this->assertFileExists(vfsStream::url('project/data/logs'));
        $this->assertFileExists(vfsStream::url('project/data/logs/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/data/cache/configcache'));
        $this->assertFileExists(vfsStream::url('project/data/cache/configcache/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/data/DoctrineModule/cache'));
        $this->assertFileExists(vfsStream::url('project/data/DoctrineModule/cache/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/data/DoctrineORMModule/Proxy'));
        $this->assertFileExists(vfsStream::url('project/data/DoctrineORMModule/Proxy/.gitignore'));
        $this->assertFileExists(vfsStream::url('project/public/upload'));


    }

}
