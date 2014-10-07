<?php
namespace Gear\Common;

use Gear\ValueObject\Config\Config;

interface ConfigAwareInterface
{
    /**
     * @param  Config $config
     * @return mixed
     */
    public function setConfig(Config $config);

    /**
     * @return mixed
     */
    public function getConfig();
}
