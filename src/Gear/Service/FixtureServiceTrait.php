<?php
namespace Gear\Service;

trait FixtureServiceTrait {

    protected $fixtureService;

    public function getFixtureService()
    {
        if (!isset($this->fixtureService)) {
            $this->fixtureService = $this->getServiceLocator()->get('Gear\Service\Fixture');
        }
        return $this->fixtureService;
    }

    public function setFixtureService($fixtureService)
    {
        $this->fixtureService = $fixtureService;
        return $this;
    }
}
