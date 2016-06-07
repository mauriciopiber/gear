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

    public function testCreateProject()
    {
        $request = $this->prophesize('Zend\Console\Request');
        $request->getParam('basepath', null)->willReturn(vfsStream::url('project'));
        $request->getParam('project', null)->willReturn('GearProject');
        $request->getParam('host', null)->willReturn('gear-project.gear.dev');
        $request->getParam('git', null)->willReturn('git@bitbucket.org:mauriciopiber/gear-project.git');
        $request->getParam('database', null)->willReturn('gear_project');
        $request->getParam('username', null)->willReturn('root');
        $request->getParam('password', null)->willReturn('password');
        $request->getParam('nfs', null)->willReturn(true);

        $string = new \GearBase\Util\String\StringService();

        //$request->getParam('project', null)->willReturn('GearProject');

        $script = $this->prophesize('Gear\Script\ScriptService');

        $cmd = '/var/www/gear-package/gear/bin/installer '
             . '"/var/www/gear-package/gear/bin" "" "GearProject" '
             . '"/GearProject" "gear-project.gear.dev" '
             . '"git@bitbucket.org:mauriciopiber/gear-project.git" '
             . '"gear_project" "root" "password" "gear-project"';

        $script->run($cmd)->willReturn(true)->shouldBeCalled();

        $this->project = new \Gear\Project\ProjectService();
        $this->project->setRequest($request->reveal());
        $this->project->setStringService($string);
        $this->project->setScriptService($script->reveal());

        $result = $this->project->create();
        $this->assertTrue($result);
    }
}
