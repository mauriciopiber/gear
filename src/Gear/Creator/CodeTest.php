<?php
namespace Gear\Creator;

use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\App\App;

class CodeTest extends AbstractCode
{
    public function getTestNamespace($data)
    {
        if (!empty($data->getNamespace())) {
            $namespace = $data->getNamespace();
            return $namespace;
        }

        return str_replace('Test', '', $data->getType());
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

            return $namespaceFile;
        }

        return $data->getType().'Test';
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

            return $location;
        }
        return $this->getModule()->map($data->getType().'Test');
    }

    /**
     * Retorna o nome das funções que são esperados no arquivo.
     *
     * @param array $dependency
     */
    public function getCandidateTest(array $dependency)
    {
        $functions = [***REMOVED***;

        foreach ($dependency as $item) {

            $namespace = explode('\\', $item);
            $className = end($namespace);

            $functions['TestSet'.$this->str('class', $className)***REMOVED*** = $item;
            $functions['TestGet'.$this->str('class', $className)***REMOVED*** = $item;
        }

        return $functions;
    }

    public function getDependencyToInject($data, $lines)
    {
        if (empty($data->getDependency())) {
            return false;
        }

        if ($data instanceof Src) {
            $this->dependency = new \Gear\Creator\Src\Dependency($data, $this->getModule());
        }

        if ($data instanceof Controller) {
            $this->dependency = new \Gear\Creator\Controller\Dependency($data, $this->getModule());
        }

        $this->uses = $this->dependency->getTests();

        $candidateFunctions = $this->getCandidateTest($this->uses);
        $functions = $this->getFunctionsNameFromFile($lines);


        foreach ($candidateFunctions as $name => $namespace) {

            if (in_array($name, $functions)) {
                unset($candidateFunctions[$name***REMOVED***);
            }
        }

        return $candidateFunctions;
    }
}
