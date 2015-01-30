<?php
namespace Gear\Common;

use Gear\Service\Type\ClassService;

trait ClassServiceTrait {

    protected $classService;

    public function getClassService()
    {
        if (!isset($this->classService)) {
            $this->classService = $this->getServiceLocator()->get('classService');
        }
        return $this->classService;
    }

    public function setClassService(ClassService $classService)
    {
        $this->classService = $classService;
        return $this;
    }
}
