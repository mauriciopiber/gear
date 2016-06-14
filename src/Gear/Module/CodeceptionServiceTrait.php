<?php
namespace Gear\Module;

use Gear\Module\CodeceptionService;

trait CodeceptionServiceTrait
{
    protected $codeception;

    public function getCodeceptionService()
    {
        if (!isset($this->codeception)) {
            $this->codeception = $this->getServiceLocator()->get('Gear\Module\Codeception');
        }
        return $this->codeception;
    }

    public function setCodeceptionService(CodeceptionService $codeceptionService)
    {
        $this->codeception = $codeceptionService;
        return $this;
    }
}
