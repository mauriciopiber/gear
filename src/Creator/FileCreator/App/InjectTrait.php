<?php
namespace Gear\Creator\FileCreator\App;

use Gear\Creator\FileCreator\App\Inject;

trait InjectTrait
{
    protected $inject;

    public function getInject()
    {
        return $this->inject;
    }

    public function setInject(
        Inject $inject
    ) {
        $this->inject = $inject;
        return $this;
    }
}
