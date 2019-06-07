<?php
namespace Gear\Creator;

use Gear\Creator\Code;

trait CodeTrait
{
    protected $code;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(Code $code)
    {
        $this->code = $code;
        return $this;
    }
}
