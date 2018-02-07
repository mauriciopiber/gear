<?php
namespace Gear\Creator\FileCreator\App;

use Gear\Creator\FileCreator\App\Inject;

trait InjectTrait
{
    protected $inject;

    public function getInject()
    {
        if (!isset($this->inject)) {
            $name = 'Gear\Creator\FileCreator\App\Inject';
            $this->inject = $this->getServiceLocator()->get($name);
        }
        return $this->inject;
    }

    public function setInject(
        Inject $inject
    ) {
        $this->inject = $inject;
        return $this;
    }
}
