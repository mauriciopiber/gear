<?php
namespace GearTest\DatabaseTest\PhinxTest;

use PHPUnit\Framework\TestCase;
use Gear\Database\Phinx\PhinxService;
use Gear\Util\String\StringService;
use org\bovigo\vfs\vfsStream;
use Gear\Creator\Template\TemplateService;
use Gear\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module;
use DateTime;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;

/**
 * @group Service
 */
class PhinxServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();


        //$this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        //$this->module->getPublicJsSpecEndFolder()
        //->willReturn(vfsStream::url('module/public/js/spec/e2e'))
        //->shouldBeCalled();

        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $templatePath = (new Module)->getLocation().'/../view';

        $resolver = new AggregateResolver();

        $map = new TemplatePathStack(array(
            'script_paths' => array(
                'template' => $templatePath,
            )
        ));

        $resolver->attach($map);

        $view = new PhpRenderer();

        $view->setResolver($resolver);

        $template       = new TemplateService($view);

        $fileService    = new FileService();
        $this->fileCreator    = new FileCreator($fileService, $template);

        $this->template = (new Module())->getLocation().'/../test/template/module/mvc/spec';

        $this->string = new StringService();
        //$this->file = new FileService();

        $this->service = new PhinxService(
            $this->string,
            $this->fileCreator
        );

        $this->root = vfsStream::setup('base');

        $this->service->setProject(vfsStream::url('base'));

        vfsStream::newDirectory('data')->at($this->root);
        vfsStream::newDirectory('data/migrations')->at($this->root);
    }


    public function migrationData()
    {
        return [
            [null, '2017-01-01 02:03:54', 'myMigration', '20170101020354_my_migration'***REMOVED***,
            //['2017-01-01 02:06:54', 'myssX Migration'***REMOVED***,
            //['2017-01-01 02:09:54', 'myssX-igration'***REMOVED***,
            //['2017-01-01 02:12:54', 'myssX igration'***REMOVED***,
            //['2017-01-01 02:15:54', 'MyssX Igration'***REMOVED***
        ***REMOVED***;
    }

    public function generateNameData()
    {
        return [
            ['2017-01-01 02:03:54', 'myMigration', '20170101020354_my_migration.php', 'MyMigration'***REMOVED***,
            ['2017-01-01 23:03:54', 'my-Migration', '20170101230354_my_migration.php', 'MyMigration'***REMOVED***,
            //['2017-01-01 02:06:54', 'myssX Migration'***REMOVED***,
            //['2017-01-01 02:09:54', 'myssX-igration'***REMOVED***,
            //['2017-01-01 02:12:54', 'myssX igration'***REMOVED***,
            //['2017-01-01 02:15:54', 'MyssX Igration'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider generateNameData
     */
    public function testGenerateValidFileName($data, $input, $file, $class)
    {
        $this->service->setNow(new DateTime($data));
        $this->assertEquals($file, $this->service->createFileName($input));
    }

    /**
     * @dataProvider generateNameData
     */
    public function testGenerateValidClassName($data, $input, $file, $class)
    {
        $this->assertEquals($class, $this->service->createClassName($input));
    }

    /**
     * @dataProvider migrationData
     * @group fucku
     */
    public function testCreateMigration($module, $date, $name, $expected)
    {
        $this->service->setNow(new DateTime($date));

        $location = $this->service->createMigration($name);

        $this->assertFileExists($location);


        $expectedFile = file_get_contents(__DIR__.'/_files/'.$expected.'.phtml');
        $result = file_get_contents($location);

        $this->assertEquals($expectedFile, $result);

    }

}
