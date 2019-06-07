<?php
namespace Gear\Mvc;

use Gear\Mvc\LanguageService;

trait LanguageServiceTrait
{
    protected $languageService;

    public function getLanguageService()
    {
        return $this->languageService;
    }

    public function setLanguageService($languageService)
    {
        $this->languageService = $languageService;
        return $this;
    }
}
