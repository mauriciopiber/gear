<?php
namespace Gear\Project;

trait ProjectLocationTrait
{
    protected $project;

    public function getProject()
    {
        if (!isset($this->project)) {
            $this->project = \GearBase\Module::getProjectFolder();
        }

        return $this->project;
    }

    public function setProject($project)
    {
        $this->project = $project;
        return $this;
    }
}
