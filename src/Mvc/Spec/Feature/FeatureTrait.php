<?php
namespace Gear\Mvc\Spec\Feature;

use Gear\Mvc\Spec\Feature\Feature;

trait FeatureTrait
{
    protected $feature;

    public function getFeature()
    {
        return $this->feature;
    }

    public function setFeature(
        Feature $feature
    ) {
        $this->feature = $feature;
        return $this;
    }
}
