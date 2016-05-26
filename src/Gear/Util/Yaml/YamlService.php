<?php
namespace Gear\Util\Yaml;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Service\AbstractJsonService;
use Symfony\Component\Yaml\Parser;
use Gear\Util\Yaml\Exception\YamlNotFoundException;

class YamlService extends AbstractJsonService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

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
