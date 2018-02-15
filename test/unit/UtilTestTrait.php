<?php
namespace GearTest;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Resolver\TemplateMapResolver;
use Gear\Creator\Template\TemplateService;
use GearBase\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module;


trait UtilTestTrait
{
    protected $fileCreator;

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
            $template       = new TemplateService();
            $template->setRenderer($this->mockPhpRenderer());

            $fileService    = new FileService();
            $this->fileCreator = new FileCreator($fileService, $template);
        }

        return $this->fileCreator;
    }
}
