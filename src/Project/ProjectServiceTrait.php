<?php
namespace Gear\Project;

trait ProjectServiceTrait
{
    protected $projectService;

    public function setProjectService($projectService)
    {
        $this->projectService = $projectService;
    }

    public function getProjectService()
    {
        return $this->projectService;
    }
}
