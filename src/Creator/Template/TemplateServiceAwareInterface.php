<?php
namespace Gear\Creator\Template;

use Gear\Creator\Template\TemplateService;

interface TemplateServiceAwareInterface
{
    /**
     * @param $writerService
     * @return mixed
     */
    public function setTemplateService(TemplateService $stringService);

    /**
     * @return mixed
     */
    public function getTemplateService();
}
