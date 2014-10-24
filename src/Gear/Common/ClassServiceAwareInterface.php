<?php
namespace Gear\Common;

use Gear\Service\Type\ClassService;

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

}
