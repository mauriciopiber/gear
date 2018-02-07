<?php
namespace Gear\Mvc;

use Gear\Mvc\LanguageService;

trait LanguageServiceTrait
{
    protected $languageService;

    public function getLanguageService()
    {
        if (!isset($this->languageService)) {
            $this->languageService = $this->getServiceLocator()->get(LanguageService::class);
        }
        return $this->languageService;
    }

    public function setLanguageService($languageService)
    {
        $this->languageService = $languageService;
        return $this;
    }
}
