<?php
namespace Gear\Common;

use Gear\Service\Filesystem\FileService;

interface FileServiceAwareInterface
{
    /**
     * @param $writerService
     * @return mixed
     */
    public function setFileService(FileService $writerService);

    /**
     * @return mixed
     */
    public function getFileService();
}
