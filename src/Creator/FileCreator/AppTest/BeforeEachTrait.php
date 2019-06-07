<?php
namespace Gear\Creator\FileCreator\AppTest;

use Gear\Creator\FileCreator\AppTest\BeforeEach;

trait BeforeEachTrait
{
    protected $beforeEach;

    public function getBeforeEach()
    {
        return $this->beforeEach;
    }

    public function setBeforeEach(
        BeforeEach $beforeEach
    ) {
        $this->beforeEach = $beforeEach;
        return $this;
    }
}
