<?php
namespace Gear\Util\Vector;

use Gear\Util\Vector\ArrayService;

trait ArrayServiceTrait
{
    protected $arrayService;

    public function getArrayService()
    {
        return $this->arrayService;
    }

    public function setArrayService(
        ArrayService $arrayService
    ) {
        $this->arrayService = $arrayService;
        return $this;
    }
}
