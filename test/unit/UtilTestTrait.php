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

trait UtilTestTrait
{
    protected $fileCreator;


    public function dummyTableService() {
        if (isset($this->tableService)) {
            return $this;
        }
        $this->tableService = $this->prophesize(TableService::class)->reveal();
        return $this;
    }

    public function dummyCode() {
        if (isset($this->code)) {
            return $this;
        }
        $this->code = $this->prophesize(Code::class)->reveal();
        return $this;
    }

    public function dummyDir() {

    }

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
}
