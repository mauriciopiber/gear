<?php
namespace Gear\Mvc;

trait LanguageServiceTrait {

    protected $languageService;

    public function getLanguageService()
    {
        if (!isset($this->languageService)) {
            $this->languageService = $this->getServiceLocator()->get('languageService');
        }
        return $this->languageService;
    }

    public function setLanguageService($languageService)
    {
        $this->languageService = $languageService;
        return $this;
    }
}