<?php
namespace Gear\Mvc\Fixture;

use Gear\Mvc\Fixture\FixtureService;

trait FixtureServiceTrait
{
    protected $fixtureService;

    public function getFixtureService()
    {
        return $this->fixtureService;
    }

    public function setFixtureService(FixtureService $fixtureService)
    {
        $this->fixtureService = $fixtureService;
        return $this;
    }
}
