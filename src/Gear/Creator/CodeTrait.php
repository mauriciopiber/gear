<?php
namespace Gear\Creator;

use Gear\Creator\File;

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

    public function setCode(File $code)
    {
        $this->code = $code;
        return $this;
    }
}
