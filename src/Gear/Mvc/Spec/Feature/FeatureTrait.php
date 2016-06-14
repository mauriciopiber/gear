<?php
namespace Gear\Mvc\Spec\Feature;

use Gear\Mvc\Spec\Feature\FeatureFactory;

trait FeatureTrait
{
    protected $feature;

    public function getFeature()
    {
        if (!isset($this->feature)) {
            $name = 'Gear\Mvc\Spec\Feature\Feature';
            $this->feature = $this->getServiceLocator()->get($name);
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
