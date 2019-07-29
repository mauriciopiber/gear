<?php
namespace Gear\Util\Yaml;

use Symfony\Component\Yaml\Parser;
use Gear\Util\Yaml\Exception\YamlNotFoundException;

class YamlService
{
    public function parse($data)
    {
        $yaml = new Parser();
        $value = $yaml->parse($data);
        return $value;
    }

    public function load($location)
    {
        if (!is_file($location)) {
            throw new YamlNotFoundException();
        }

        return $this->parse(file_get_contents($location));
    }
}
