<?php
namespace Gear\Service\Column;

interface UniqueInterface
{
    public function getUniqueConstraint();

    public function setUniqueConstraint($uniqueConstraint);
}
