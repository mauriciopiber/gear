<?php
namespace Gear\Service\Filesystem;

use Gear\Service\Filesystem\DirService;

interface DirServiceAwareInterface
{
    /**
     * @param $writerService
     * @return mixed
     */
    public function setDirService(DirService $writerService);

    /**
     * @return mixed
     */
    public function getDirService();
}
