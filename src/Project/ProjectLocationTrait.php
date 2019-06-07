<?php
namespace Gear\Project;

trait ProjectLocationTrait
{
    protected $project;

    public function getProject()
    {

        return $this->project;
    }

    public function setProject($project)
    {
        $this->project = $project;
        return $this;
    }
}
