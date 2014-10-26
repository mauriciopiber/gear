<?php
namespace Gear\Common;

trait ProjectServiceTrait {

    protected $projectService;

    public function setProjectService($projectService)
    {
        $this->projectService = $projectService;
    }

    public function getProjectService()
    {
        if (!isset($this->projectService)) {
            $this->projectService = $this->getServiceLocator()->get('projectService');
        }
        return $this->projectService;
    }
}