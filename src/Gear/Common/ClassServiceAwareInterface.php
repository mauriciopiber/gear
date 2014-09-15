<?php
namespace Gear\Common;

use Gear\Service\Filesystem\ClassService;

interface ClassServiceAwareInterface
{
    /**
     * @param $writerService
     * @return mixed
     */
    public function setClassService(ClassService $phpFileService);

    /**
     * @return mixed
     */
    public function getClassService();

    public function getIndent($indent, $patters);

    public function powerline($indent, $text, $params, $newline);
}
