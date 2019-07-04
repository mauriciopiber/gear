<?php
namespace Gear\Code;

use Gear\Code\Code;

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
