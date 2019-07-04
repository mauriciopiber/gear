<?php
namespace Gear\Code;

use Gear\Code\CodeTest;

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
