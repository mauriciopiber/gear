<?php
namespace Gear\Service;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use GearBase\Util\File\FileServiceTrait;
use GearBase\Util\File\FileServiceAwareInterface;
use GearBase\Util\Dir\DirServiceTrait;
use GearBase\Util\Dir\DirServiceAwareInterface;
use GearBase\Util\String\StringServiceAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Util\Vector\ArrayServiceAwareInterface;
use Gear\Module\ModuleAwareInterface;
use Gear\Creator\TemplateServiceTrait;
use Gear\Module\ModuleAwareTrait;
use GearBase\RequestTrait;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @author piber
 */
abstract class AbstractService implements
    ServiceLocatorAwareInterface,
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ArrayServiceAwareInterface,
    ModuleAwareInterface
{
    use RequestTrait;

    use ModuleAwareTrait;

    use ServiceLocatorAwareTrait;

    use ArrayServiceTrait;

    use StringServiceTrait;

    use DirServiceTrait;

    use FileServiceTrait;

    use TemplateServiceTrait;

    protected $adapter;

    protected $options;

    public function setConfig(Config $config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        if (!isset($this->config)) {
            $this->config = $this->getServiceLocator()->get('config');
        }
        return $this->config;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
