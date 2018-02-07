<?php
namespace Gear\Creator;

use Gear\Creator\CodeTest;

trait CodeTestTrait
{
    protected $codeTest;

    public function getCodeTest()
    {
        if (!isset($this->codeTest)) {
            $this->codeTest = $this->getServiceLocator()->get('Gear\Creator\CodeTest');
        }
        return $this->codeTest;
    }

    public function setCodeTest(CodeTest $codeTest)
    {
        $this->codeTest = $codeTest;
        return $this;
    }
}
