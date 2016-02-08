<?php
namespace Gear\Creator;

use Gear\Creator\TemplateService;

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
