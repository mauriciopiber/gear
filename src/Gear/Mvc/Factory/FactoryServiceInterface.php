<?php
namespace Gear\Mvc\Factory;

use Gear\Mvc\Factory\FactoryInterface;

interface FactoryServiceInterface
{
    /* @var $factoryService Gear\Mvc\Factory\FactoryService */
    public function setFactoryInterface(FactoryInterface $factoryInterface);

    public function getFactoryInterface();
}
