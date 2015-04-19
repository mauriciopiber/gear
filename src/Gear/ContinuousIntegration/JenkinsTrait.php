<?php
namespace Gear\ContinuousIntegration;

trait JenkinsTrait {

    protected $jenkins;

    public function getJenkins()
    {
        if (!isset($this->jenkins)) {
            $this->jenkins = $this->getServiceLocator()->get('Gear\ContinuousIntegration\Jenkins');
        }
        return $this->jenkins;
    }

    public function setJenkins($jenkins)
    {
        $this->jenkins = $jenkins;
        return $this;
    }
}