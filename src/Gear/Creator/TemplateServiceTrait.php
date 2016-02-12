<?php
namespace Gear\Creator;

use Gear\Creator\TemplateService;

trait TemplateServiceTrait
{
    protected $templateService;

    public function getTemplateService()
    {
        if (!isset($this->templateService)) {
            $this->templateService = $this->getServiceLocator()->get('Gear\Creator\Template');
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
            throw new \Gear\Creator\Exception\TemplateNotFoundException();
        }

        return $this->templates[$template***REMOVED***;
    }
}
