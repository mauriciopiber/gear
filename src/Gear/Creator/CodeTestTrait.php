<?php
namespace Gear\Creator;

use Gear\Creator\File;

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

    public function setCodeTest(File $codeTest)
    {
        $this->codeTest = $codeTest;
        return $this;
    }
}
