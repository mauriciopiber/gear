<?php
namespace Gear\Column;

interface UniqueInterface
{
    public function getUniqueConstraint();

    public function setUniqueConstraint($uniqueConstraint);
}
