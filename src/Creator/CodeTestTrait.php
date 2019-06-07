<?php
namespace Gear\Creator;

use Gear\Creator\CodeTest;

trait CodeTestTrait
{
    protected $codeTest;

    public function getCodeTest()
    {
        return $this->codeTest;
    }

    public function setCodeTest(CodeTest $codeTest)
    {
        $this->codeTest = $codeTest;
        return $this;
    }
}
