<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\CodeTrait;
use Gear\Mvc\TraitServiceTrait;
use Gear\Mvc\InterfaceServiceTrait;
use Gear\Mvc\Factory\FactoryServiceTrait;

abstract class AbstractMvc extends AbstractJsonService
{
    use CodeTrait;
    use InterfaceServiceTrait;
    use TraitServiceTrait;
    use FactoryServiceTrait;
}
