<?php
namespace Gear\Common;

interface WritableAwareInterface
{
    public function getLocation();

    public function getName();

    public function getContent();

    /**
     * @return string String formatada
     */
    public function write();
}
