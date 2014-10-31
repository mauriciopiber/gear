<?php
namespace Gear\Common;

use Gear\Service\TemplateService;

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
