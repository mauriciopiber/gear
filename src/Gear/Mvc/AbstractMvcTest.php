<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\FileNamespaceInterface;
use Gear\Creator\FileLocationInterface;
use Gear\Creator\FileTestNamespaceInterface;

abstract class AbstractMvcTest extends AbstractJsonService implements
    FileNamespaceInterface,
    FileTestNamespaceInterface,
    FileLocationInterface
{
    public function getTestNamespace($data)
    {
        if (!empty($data->getNamespace())) {
            $namespace = $data->getNamespace();
            return $namespace;
        }

        return str_replace('Test', '', static::$defaultNamespace);
    }

    public function getNamespace($data)
    {
        if (!empty($data->getNamespace())) {

            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item.'Test';
            }

            $implode = implode('\\', $psr);

            $namespaceFile = $implode;

            $namespace = $data->getNamespace();

            return $namespace;
        }

        return static::$defaultNamespace;
    }

    public function getLocation($data)
    {
        if (!empty($data->getNamespace())) {

            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item.'Test';
            }

            $location = $this->getModule()->getTestUnitModuleFolder().'/'.implode('/', $psr);

            $this->getDirService()->mkDeepDir(implode('/', $psr), $this->getModule()->getTestUnitModuleFolder());
            $this->getDirService()->mkDir($location);
        }
        return static::$defaultLocation;
    }
}
