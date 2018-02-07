<?php
namespace Gear\Creator;

use Gear\Creator\Code;

trait CodeTrait
{
    protected $code;

    public function getCode()
    {
        if (!isset($this->code)) {
            $this->code = $this->getServiceLocator()->get('Gear\Creator\Code');
        }
        return $this->code;
    }

    public function setCode(Code $code)
    {
        $this->code = $code;
        return $this;
    }
}
