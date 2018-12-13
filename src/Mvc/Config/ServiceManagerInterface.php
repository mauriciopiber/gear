<?php
namespace Gear\Mvc\Config;

use Gear\Schema\Src\Src;

interface ServiceManagerInterface
{
    public function create(Src $src);

    public function delete(Src $src);

    public function get(Src $src);
}
