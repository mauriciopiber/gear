<?php
namespace GearTest\ProjectTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

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
     */
    public function testCreateProject($name, $host, $git, $database, $user, $pass, $nfs)
    {
        $request = $this->prophesize('Zend\Console\Request');
        $request->getParam('basepath', null)->willReturn(vfsStream::url('project'));
        $request->getParam('project', null)->willReturn($name);
        $request->getParam('host', null)->willReturn($host);
        $request->getParam('git', null)->willReturn($git);
        $request->getParam('database', null)->willReturn($database);
        $request->getParam('username', null)->willReturn($user);
        $request->getParam('password', null)->willReturn($pass);
        $request->getParam('nfs', null)->willReturn($nfs);

        $string = new \GearBase\Util\String\StringService();


        $project = new \Gear\Project\Project(array(
            'project'  => $name,
            'host'     => $host,
            'git'      => $git,
            'database' => $database,
            'username' => $user,
            'password' => $pass,
            'nfs'      => $nfs,
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

        $config = $this->prophesize('Gear\Config\Service\ConfigService');
        $config->setUPGlobalProject($global, "/GearProject")->willReturn(true)->shouldBeCalled();
        $config->setUpLocalProject($local, "/GearProject")->willReturn(true)->shouldBeCalled();
        $config->setUpEnvironmentProject($local, "/GearProject")->willReturn(true)->shouldBeCalled();

        //$request->getParam('project', null)->willReturn('GearProject');

        $fileCreator = $this->prophesize('Gear\Creator\File');


        $composerService = $this->prophesize('Gear\Project\Composer\ComposerService');
        $composerService->createComposer($project)->willReturn(true)->shouldBeCalled();
        $composerService->runComposerUpdate($project)->willReturn(true)->shouldBeCalled();


        $script = $this->prophesize('Gear\Script\ScriptService');

        $script->setLocation('/GearProject')->willReturn(true)->shouldBeCalled();

        $cmd = '/var/www/gear-package/gear/bin/installer-utils/clone-skeleton /GearProject';
        $script->run($cmd)->willReturn(true)->shouldBeCalled();


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

        $this->project = new \Gear\Project\ProjectService();
        $this->project->setFileCreator($fileCreator->reveal());
        $this->project->setRequest($request->reveal());
        $this->project->setStringService($string);
        $this->project->setScriptService($script->reveal());
        $this->project->setConfigService($config->reveal());
        $this->project->setDirService($dirService->reveal());
        $this->project->setFileService($fileService->reveal());
        $this->project->setComposerService($composerService->reveal());

        $result = $this->project->create();
        $this->assertTrue($result);
    }
}
