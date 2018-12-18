<?php
namespace GearTest\ProjectTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Database\BackupService;

/**
 * @group Database
 */
class BackupServiceTest extends TestCase
{
    public $dbname = 'my-db';

    public $user = 'my-user';

    public $password = 'my-pass';

    public function setUp()
    {
        parent::setUp();

        $this->script = $this->prophesize('Gear\Util\Script\ScriptService');

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'MyProject'
                ***REMOVED***
            ***REMOVED***,
            'doctrine' => [
                'connection' => [
                    'orm_default' => [
                        'params' => [
                            'dbname'   => $this->dbname,
                            'user'     => $this->user,
                            'password' => $this->password
                        ***REMOVED***
                    ***REMOVED***

                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;
        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->string = new \Gear\Util\String\StringService;

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');

        $project = vfsStream::setup('project');
        vfsStream::newDirectory('data')->at($project);

        file_put_contents(vfsStream::url('project/data/my-project.mysql.sql'), '...');

        $this->request = $this->prophesize('Zend\Console\Request');

        $this->backup = new BackupService(
            $this->config,
            $this->string,
            $this->script->reveal(),
            $this->console->reveal(),
            $this->module->reveal(),
            $this->request->reveal()
        );

    }

    /**
     * @group pl
     */
    public function testProjectLoad()
    {
        $file = 'vfs://project/data/my-project.mysql.sql';

        $this->script->runScriptAt(
            sprintf('mysql -u my-user --password=my-pass my-db < %s', $file)
        )->willReturn(true)
        ->shouldBeCalled();

        $this->console->writeLine(sprintf(BackupService::LOADED, $file))->shouldBeCalled();
        //$this->console->writeLine('vfs://project/data/my-project.mysql.sql')->shouldBeCalled();

        $this->backup->setModuleFolder(vfsStream::url('project'));
        $file = $this->backup->projectLoad();

        $this->assertEquals('vfs://project/data/my-project.mysql.sql', $file);
    }

    /**
     * @group pl
     */
    public function testProjectDump()
    {
        $file = 'vfs://project/data/my-project.mysql.sql';

        $this->script->runScriptAt(
            sprintf('mysqldump -u my-user --password=my-pass --opt my-db > %s', $file)
        )->willReturn(true)
        ->shouldBeCalled();

        $this->console->writeLine(sprintf(BackupService::DUMPED, $file))->shouldBeCalled();
        //$this->console->writeLine('vfs://project/data/my-project.mysql.sql')->shouldBeCalled();

        $this->backup->setModuleFolder(vfsStream::url('project'));

        $file = $this->backup->projectDump();

        $this->assertEquals('vfs://project/data/my-project.mysql.sql', $file);
    }

    /**
     * @group ml
     */
    public function testModuleLoad()
    {
        $file = 'vfs://module/my-module.mysql.sql';

        $module = vfsStream::setup('module');

        file_put_contents(vfsStream::url('module/my-module.mysql.sql'), '...');

        $this->script->runScriptAt(
            sprintf('mysql -u my-user --password=my-pass my-db < %s', $file)
        )->willReturn(true)
        ->shouldBeCalled();

        $this->console->writeLine(sprintf(BackupService::LOADED, $file))->shouldBeCalled();


        $this->module->getDataFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->backup->moduleLoad();

        $this->assertEquals('vfs://module/my-module.mysql.sql', $file);
    }

    /**
     * @group ml
     */
    public function testModuleDump()
    {
        $file = 'vfs://module/my-module.mysql.sql';

        $module = vfsStream::setup('module');

        file_put_contents(vfsStream::url('module/my-module.mysql.sql'), '...');


        $this->script->runScriptAt(
            sprintf('mysqldump -u my-user --password=my-pass --opt my-db > %s', $file)
        )->willReturn(true)
        ->shouldBeCalled();

        $this->console->writeLine(sprintf(BackupService::DUMPED, $file))->shouldBeCalled();

        $this->module->getDataFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->backup->moduleDump();

        $this->assertEquals('vfs://module/my-module.mysql.sql', $file);
    }

    /**
     * @group dl
     * @group dl1
     */
    public function testDump()
    {
        $file = 'vfs://module/data/my-load.mysql.sql';

        $module = vfsStream::setup('module');
        vfsStream::newDirectory('data')->at($module);

        $this->backup->setModuleFolder(vfsStream::url('module'));
        file_put_contents(vfsStream::url('module/data/my-load.mysql.sql'), '...');

        $this->script->runScriptAt(
            sprintf('mysqldump -u my-user --password=my-pass --opt my-db > %s', $file)
        )->willReturn(true);

        $this->request->getParam('location')->willReturn('data/my-load.mysql.sql')->shouldBeCalled();

        $file = $this->backup->dump();
    }

    /**
     * @group dl
     * @group dl2
     */
    public function testLoad()
    {
        $module = vfsStream::setup('module');
        vfsStream::newDirectory('data')->at($module);

        $this->backup->setModuleFolder(vfsStream::url('module'));
        file_put_contents(vfsStream::url('module/data/my-load.mysql.sql'), '...');

        $this->script->runScriptAt(
            'mysql -u my-user --password=my-pass my-db < vfs://module/data/my-load.mysql.sql'
            )->willReturn(true)
        ->shouldBeCalled();

        $this->request->getParam('location')->willReturn('data/my-load.mysql.sql')->shouldBeCalled();

        $file = $this->backup->load();
    }
}
