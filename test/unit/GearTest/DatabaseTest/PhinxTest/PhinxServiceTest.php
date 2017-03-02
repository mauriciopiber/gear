<?php
namespace GearTest\DatabaseTest\PhinxTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Database\Phinx\PhinxService;
use GearBase\Util\String\StringService;
use org\bovigo\vfs\vfsStream;
use Gear\Creator\TemplateService;
use GearBase\Util\File\FileService;
use Gear\Creator\File;
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
        
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        //$this->module->getPublicJsSpecEndFolder()
        //->willReturn(vfsStream::url('module/public/js/spec/e2e'))
        //->shouldBeCalled();
        
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $templatePath = (new Module)->getLocation().'/../../view';
        
        $resolver = new AggregateResolver();
        
        $map = new TemplatePathStack(array(
            'script_paths' => array(
                'template' => $templatePath,
            )
        ));
        
        $resolver->attach($map);
        
        $view = new PhpRenderer();
        
        $view->setResolver($resolver);
        
        $template       = new TemplateService();
        $template->setRenderer($view);
        
        $fileService    = new FileService();
        $this->fileCreator    = new File($fileService, $template);
        
        $this->template = (new Module())->getLocation().'/../../test/template/module/mvc/spec';
        
        $this->string = new StringService();
        //$this->file = new FileService();

        $this->service = new PhinxService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string
        );
    }
    
    
    public function migrationData()
    {
        return [
            ['2017-01-01 02:03:54', 'myMigration'***REMOVED***,
            ['2017-01-01 02:06:54', 'myssX Migration'***REMOVED***,
            ['2017-01-01 02:09:54', 'myssX-igration'***REMOVED***,
            ['2017-01-01 02:12:54', 'myssX igration'***REMOVED***,
            ['2017-01-01 02:15:54', 'MyssX Igration'***REMOVED***
        ***REMOVED***;
    }
    
    /**
     * @dataProvider migrationData
     */
    public function testCreateMigration($date, $name)
    {
        $this->service->setNow(new DateTime($date));
        
        $this->assertTrue($this->service->createMigration(null, $name));
        
    }

}
