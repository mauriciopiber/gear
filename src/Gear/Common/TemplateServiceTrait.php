<?php
namespace Gear\Common;

use Gear\Service\TemplateService;

trait TemplateServiceTrait {

    protected $templateService;

    public function getTemplateService()
    {
        if (!isset($this->templateService)) {
            $this->templateService = $this->getServiceLocator()->get('Gear\Service\Template');
        }
        return $this->templateService;
    }

    public function setTemplateService(TemplateService $templateService)
    {
        $this->templateService = $templateService;
        return $this;
    }
}
