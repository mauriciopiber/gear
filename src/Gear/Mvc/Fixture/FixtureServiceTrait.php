<?php
namespace Gear\Mvc\Fixture;

use Gear\Mvc\Fixture\FixtureService;

trait FixtureServiceTrait
{
    protected $fixtureService;

    public function getFixtureService()
    {
        if (!isset($this->fixtureService)) {
            $this->fixtureService = $this->getServiceLocator()->get('Gear\Mvc\Fixture\FixtureService');
        }
        return $this->fixtureService;
    }

    public function setFixtureService(FixtureService $fixtureService)
    {
        $this->fixtureService = $fixtureService;
        return $this;
    }
}
