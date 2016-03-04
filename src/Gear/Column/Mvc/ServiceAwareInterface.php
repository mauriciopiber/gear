<?php
namespace Gear\Column\Mvc;

interface ServiceAwareInterface
{
    public function getServiceInsertBody();

    public function getServiceInsertSuccess();

    public function getServiceUpdateBody();

    public function getServiceUpdateSuccess();

    //public function updateToInject();

    //public function functionsToInject();

    //public function useToInject();

    //public function attributeToInject();
}
