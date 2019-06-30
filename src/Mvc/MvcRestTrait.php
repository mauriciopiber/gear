<?php
namespace Gear\Mvc;

use Gear\Schema\AbstractSrcObject;
use Gear\Schema\Src\Src;
use Gear\Schema\Controller\Controller;
use Gear\Rest\Controller\AbstractRestController;
use Gear\Rest\Filter\RestFilterInterface;
use Gear\Rest\Service\AbstractRestService;
use Gear\Rest\Repository\AbstractRestRepository;

trait MvcRestTrait
{
    public function isRest(AbstractSrcObject $element)
    {
        // var_dump(1, $element instanceof Controller);
        // var_dump(2, $element->getExtends() == AbstractRestController::class);
        if ($element instanceof Controller
            && $element->getExtends() == '\\'.AbstractRestController::class
        ) {
            return true;
        }

        if ($element instanceof Src
            && $element->getType() == 'Service'
            && $element->getExtends() == '\\'.AbstractRestService::class
        ) {
            return true;
        }


        if ($element instanceof Src
            && $element->getType() == 'Repository'
            && $element->getExtends() == '\\'.AbstractRestRepository::class
        ) {
            return true;
        }


        if ($element instanceof Src
            && $element->getType() == 'Filter'
            && $element->getImplements() !== null
            && in_array('\\'.RestFilterInterface::class, $element->getImplements())
        ) {
            return true;
        }

        return false;
    }
}
