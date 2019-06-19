<?php
namespace GearTest;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Resolver\TemplateMapResolver;
use Gear\Creator\Template\TemplateService;
use Gear\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module;
use Gear\Table\TableService\TableService;
use Gear\Creator\Code;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\Dir\DirService;
use Gear\Util\String\StringService;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Util\Vector\ArrayService;

trait UtilTestTrait
{
    protected $fileCreator;

    protected $code;

    protected $codeTest;

    protected $dir;

    protected $constructorParams;

    public function createConstructorParams()
    {
        if (isset($this->constructorParams)) {
            return $this->constructorParams;
        }

        $this->constructorParams = new ConstructorParams($this->createString());
        return $this->constructorParams;
    }

    public function createString()
    {
        if (isset($this->string)) {
            return $this->string;
        }
        $this->string = new StringService();
        return $this->string;
    }


    // public function dummyTableService() {
    //     if (isset($this->tableService)) {
    //         return $this;
    //     }
    //     $this->tableService = $this->prophesize(TableService::class)->reveal();
    //     return $this;
    // }

    // public function dummyCode() {
    //     if (isset($this->code)) {
    //         return $this;
    //     }
    //     $this->code = $this->prophesize(Code::class)->reveal();
    //     return $this;
    // }

    // public function dummyDir() {

    // }

    public function createVirtualDir($location)
    {
        $folders = explode('/', $location);

        $base = array_shift($folders);

        vfsStream::setup($base);

        $workFolder = '';


        foreach ($folders as $i => $folder) {
            $workFolder .= (($i>0) ? '/' : '') . $folder;
            vfsStream::newDirectory($workFolder)->at(vfsStreamWrapper::getRoot());
        }

        return $base.'/'.$workFolder;
    }

    public function createTemplate($name, $templatePath)
    {
      $view = new PhpRenderer();

      $resolver = new AggregateResolver();

      $map = new TemplatePathStack([
          'script_paths' => [
              $name => $templatePath,
          ***REMOVED***
      ***REMOVED***);

      $resolver->attach($map);
      $view->setResolver($resolver);

      return $view;
    }


    /**
     * Cria Zend\View\Renderer\PhpRenderer
     */
    public function mockPhpRenderer()
    {
        $templatePath = (new Module)->getLocation().'/../view';

        $view = new PhpRenderer();

        $resolver = new AggregateResolver();

        $map = new TemplatePathStack([
            'script_paths' => [
                'template' => $templatePath,
            ***REMOVED***
        ***REMOVED***);

        $resolver->attach($map);
        $view->setResolver($resolver);

        return $view;
    }

    public function createFileCreator()
    {
        if ($this->fileCreator === null) {
            $template       = new TemplateService($this->mockPhpRenderer());

            $fileService    = new FileService();
            $this->fileCreator = new FileCreator($fileService, $template);
        }

        return $this->fileCreator;
    }

    public function createCode() {


        if ($this->code) {
            return $this->code;
        }

        $this->code = new Code(
            $this->module ? $this->module->reveal() : $this->prophesize(ModuleStructure::class)->reveal(),
            $this->string ? $this->string : $this->prophesize(StringService::class)->reveal(),
            $this->dir ? $this->dir : new DirService(),
            $this->createConstructorParams()
        );

        return $this->code;
    }

    public function createModule()
    {
        if (isset($this->module)) {
            return $this->module;
        }
        $this->module = $this->prophesize(ModuleStructure::class);
        return $this->module;
    }

    public function createCodeTest() {

        if ($this->codeTest) {
            return $this->codeTest;
        }

        $this->codeTest = new \Gear\Creator\CodeTest(
            $this->createModule()->reveal(),
            $this->createString(),
            new DirService(),
            new ArrayService()
        );

        return $this->codeTest;

        // $this->codeTest->setModule($this->module->reveal());
        // $this->codeTest->setFileCreator($this->fileCreator);

        // $this->codeTest->setDirService(new \Gear\Util\Dir\DirService());
        // $this->codeTest->setStringService($this->string);

    }

    public function createCodeMock() {

    }
}
