<?php
namespace Gear\Creator\Template;

use Gear\Creator\Template\TemplateService;
use Gear\Creator\Template\Exception\TemplateNotFoundException;

trait TemplateServiceTrait
{
    protected $templateService;

    public function getTemplateService()
    {
        if (!isset($this->templateService)) {
            $this->templateService = $this->getServiceLocator()->get(TemplateService::class);
        }
        return $this->templateService;
    }

    public function setTemplateService(TemplateService $templateService)
    {
        $this->templateService = $templateService;
        return $this;
    }

    public function getTemplate($template)
    {
        if (!isset($this->templates[$template***REMOVED***)) {
            throw new TemplateNotFoundException();
        }

        return $this->templates[$template***REMOVED***;
    }
}
