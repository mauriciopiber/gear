<?php
namespace Gear\Creator\FileCreator\AppTest;

use Gear\Creator\FileCreator\AppTest\BeforeEach;

trait BeforeEachTrait
{
    protected $beforeEach;

    public function getBeforeEach()
    {
        if (!isset($this->beforeEach)) {
            $name = 'Gear\Creator\FileCreator\AppTest\BeforeEach';
            $this->beforeEach = $this->getServiceLocator()->get($name);
        }
        return $this->beforeEach;
    }

    public function setBeforeEach(
        BeforeEach $beforeEach
    ) {
        $this->beforeEach = $beforeEach;
        return $this;
    }
}
