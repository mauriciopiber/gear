<?php
namespace GearTest;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

trait UtilTestTrait
{
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

    public function createFileCreator()
    {
        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        return new \Gear\Creator\File($fileService, $template);
    }
}
