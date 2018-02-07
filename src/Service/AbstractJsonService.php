<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Table\Metadata\MetadataTrait;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Creator\AppDependencyTrait;
use Gear\Util\Yaml\YamlServiceTrait;
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
use Gear\Creator\Template\TemplateServiceTrait;
use Gear\Module\ModuleAwareTrait;
use GearBase\RequestTrait;

abstract class AbstractJsonService implements
    ServiceLocatorAwareInterface,
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ArrayServiceAwareInterface,
    ModuleAwareInterface,
    EventManagerAwareInterface
{
    use RequestTrait;

    use ModuleAwareTrait;

    use ServiceLocatorAwareTrait;

    use ArrayServiceTrait;

    use StringServiceTrait;

    use DirServiceTrait;

    use FileServiceTrait;

    use TemplateServiceTrait;

    use YamlServiceTrait;

    use TableServiceTrait;

    use EventManagerAwareTrait;

    use FileCreatorTrait;

    use MetadataTrait;

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


    public function setBaseDir($dir)
    {
        $this->dir = $dir;
        return $this;
    }

    public function getBaseDir()
    {
        if (empty($this->dir)) {
            $this->dir = \GearBase\Module::getProjectFolder();
        }
        return $this->dir;
    }
}
