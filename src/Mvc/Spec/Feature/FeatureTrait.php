<?php
namespace Gear\Mvc\Spec\Feature;

use Gear\Mvc\Spec\Feature\Feature;

trait FeatureTrait
{
    protected $feature;

    public function getFeature()
    {
        if (!isset($this->feature)) {
            $this->feature = $this->getServiceLocator()->get(Feature::class);
        }
        return $this->feature;
    }

    public function setFeature(
        Feature $feature
    ) {
        $this->feature = $feature;
        return $this;
    }
}
