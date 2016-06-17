<?php
namespace GearTest\ProjectTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group Database
 */
class BackupServiceTest extends AbstractTestCase
{
    public $dbname = 'my-db';

    public $user = 'my-user';

    public $password = 'my-pass';

    public function setUp()
    {
        parent::setUp();

        $this->script = $this->prophesize('Gear\Script\ScriptService');

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
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->string = new \GearBase\Util\String\StringService;

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');


        /**
        vfsStream::setUp('project');

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->templates = (new \Gear\Module())->getLocation().'/../../test/template/project/config/autoload';
        */


        $project = vfsStream::setup('project');
        vfsStream::newDirectory('data')->at($project);

        file_put_contents(vfsStream::url('project/data/my-project.mysql.sql'), '...');
    }



    public function testProjectLoad()
    {

        $this->script->run(
            'mysql -u my-user --password=my-pass my-db < vfs://project/data/my-project.mysql.sql'
        )->willReturn(true)
        ->shouldBeCalled();

        $this->console->writeLine('Carregado my-project.mysql.sql')->shouldBeCalled();
        $this->console->writeLine('vfs://project/data/my-project.mysql.sql')->shouldBeCalled();


        $this->backup = new \Gear\Database\BackupService(
            $this->config,
            $this->string,
            $this->script->reveal(),
            $this->console->reveal(),
            $this->module->reveal()
        );
        $this->backup->setProject(vfsStream::url('project'));
        $file = $this->backup->projectLoad();

        $this->assertEquals('vfs://project/data/my-project.mysql.sql', $file);
    }

    public function testProjectDump()
    {

        $this->script->run(
            'mysqldump -u my-user --password=my-pass --opt my-db > vfs://project/data/my-project.mysql.sql'
        )
        ->willReturn(true)
        ->shouldBeCalled();

        $this->console->writeLine('Criado my-project.mysql.sql')->shouldBeCalled();
        $this->console->writeLine('vfs://project/data/my-project.mysql.sql')->shouldBeCalled();

        $this->backup = new \Gear\Database\BackupService(
            $this->config,
            $this->string,
            $this->script->reveal(),
            $this->console->reveal(),
            $this->module->reveal()
        );
        $this->backup->setProject(vfsStream::url('project'));

        $file = $this->backup->projectDump();

        $this->assertEquals('vfs://project/data/my-project.mysql.sql', $file);
    }

    public function testModuleLoad()
    {
        $module = vfsStream::setup('module');

        file_put_contents(vfsStream::url('module/my-module.mysql.sql'), '...');

        $this->script->run(
            'mysql -u my-user --password=my-pass my-db < vfs://module/my-module.mysql.sql'
        )->willReturn(true)
        ->shouldBeCalled();

        $this->console->writeLine('Carregado my-module.mysql.sql')->shouldBeCalled();
        $this->console->writeLine('vfs://module/my-module.mysql.sql')->shouldBeCalled();


        $this->module->getDataFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();


        $this->backup = new \Gear\Database\BackupService(
            $this->config,
            $this->string,
            $this->script->reveal(),
            $this->console->reveal(),
            $this->module->reveal()
        );

        $file = $this->backup->moduleLoad();

        $this->assertEquals('vfs://module/my-module.mysql.sql', $file);
    }

    /**
     * @group 11
     */
    public function testModuleDump()
    {
        $module = vfsStream::setup('module');


        file_put_contents(vfsStream::url('module/my-module.mysql.sql'), '...');


        $this->script->run(
            'mysqldump -u my-user --password=my-pass --opt my-db > vfs://module/my-module.mysql.sql'
        )->willReturn(true)
        ->shouldBeCalled();

        $this->console->writeLine('Criado my-module.mysql.sql')->shouldBeCalled();
        $this->console->writeLine('vfs://module/my-module.mysql.sql')->shouldBeCalled();


        $this->module->getDataFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->backup = new \Gear\Database\BackupService(
            $this->config,
            $this->string,
            $this->script->reveal(),
            $this->console->reveal(),
            $this->module->reveal()
        );

        $file = $this->backup->moduleDump();

        $this->assertEquals('vfs://module/my-module.mysql.sql', $file);
    }
}
