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
use Gear\Util\File\FileServiceTrait;
use Gear\Util\File\FileServiceAwareInterface;
use Gear\Util\Dir\DirServiceTrait;
use Gear\Util\Dir\DirServiceAwareInterface;
use Gear\Util\String\StringServiceAwareInterface;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Util\Vector\ArrayServiceAwareInterface;
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Creator\Template\TemplateServiceTrait;
use Gear\Module\Structure\ModuleStructureTrait;

abstract class AbstractJsonService implements
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ArrayServiceAwareInterface,
    ModuleStructureInterface,
    EventManagerAwareInterface
{
    use ModuleStructureTrait;


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

    protected $request;

    public function getRequest()
    {
        if (!isset($this->request)) {
            $this->request = $this->get('application')->getMvcEvent()->getRequest();
        }
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
}
