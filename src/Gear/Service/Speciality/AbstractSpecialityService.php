<?php
namespace Gear\Service\Speciality;

use Gear\Service\AbstractJsonService;

abstract class AbstractSpecialityService extends AbstractJsonService {

    abstract function getFormElement($var, $name, $id, $label);

    abstract function getFilterElement();

    abstract function getViewFormElement($name);

    abstract function getViewRowElement();
}
