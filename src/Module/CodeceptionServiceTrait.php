<?php
namespace Gear\Module;

use Gear\Module\CodeceptionService;

trait CodeceptionServiceTrait
{
    protected $codeception;

    public function getCodeceptionService()
    {
        return $this->codeception;
    }

    public function setCodeceptionService(CodeceptionService $codeceptionService)
    {
        $this->codeception = $codeceptionService;
        return $this;
    }
}
