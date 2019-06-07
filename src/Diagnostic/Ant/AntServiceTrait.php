<?php
namespace Gear\Diagnostic\Ant;

use Gear\Diagnostic\Ant\AntService;

trait AntServiceTrait
{
    protected $antService;

    public function getAntService()
    {
        return $this->antService;
    }

    public function setAntService(AntService $antService)
    {
        $this->antService = $antService;
        return $this;
    }
}
