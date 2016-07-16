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

    /**
     * Retorna o nome completo da classe que será utilizada.
     * no formato [Module***REMOVED***\[Namespace***REMOVED***\[Name***REMOVED***
     * Essa função deve ser transferida para abstractCode, serve para retornar todo caminho para uma classe.
     */
    public function getFullClassName($data)
    {

        if (!empty($data->getNamespace())) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item;
            }

            $implode = implode('\\', $psr);

            $namespace = $implode;
        } else {
            if ($data instanceof Src) {
                $namespace = $data->getType();
            } else {
                $namespace = 'Controller';
            }
        }

        return $this->getModule()->getModuleName().'\\'.$namespace.'\\'.$data->getName();
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

        if ($data instanceof Src) {
            return $data->getType().'Test';
        } else {
            return 'ControllerTest';
        }
    }

    public function getLocationPath($data)
    {
        if ($data instanceof Src || $data instanceof Controller) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item.'Test';
            }

            $location = $this->getModule()->getTestUnitModuleFolder().'/'.implode('/', $psr);

            $this->getDirService()->mkDeepDir(implode('/', $psr), $this->getModule()->getTestUnitModuleFolder());
            $this->getDirService()->mkDir($location);

            return $location;
        }


        if ($data instanceof App) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $this->str('var', $item).'Spec';
            }

            $location = $this->getModule()->getPublicJsSpecUnitFolder().'/'.implode('/', $psr);

            $this->getDirService()->mkDeepDir(implode('/', $psr), $this->getModule()->getPublicJsSpecUnitFolder());
            $this->getDirService()->mkDir($location);

            echo $location."\n";

            return $location;
        }
    }


    public function getLocation($data)
    {
        if (!empty($data->getNamespace())) {
            $location = $this->getLocationPath($data);
            return $location;
        }

        $type = $this->str('class', $data->getType());

        if ($data instanceof App) {
            $type = 'App'.$type.'Spec';
        } else {
            $type .= 'Test';
        }

        //var_dump($type);
        //var_dump($this->getModule()->map($type));
        return $this->getModule()->map($type);
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

        /* Load Dependency */
        $this->loadDependencyService($data);

        $this->uses = $this->dependency->getTests();

        $candidateFunctions = $this->getCandidateTest($this->uses);
        $functions = $this->getFunctionsNameFromFile($lines);


        foreach (array_keys($candidateFunctions) as $name) {
            if (in_array($name, $functions)) {
                unset($candidateFunctions[$name***REMOVED***);
            }
        }

        return $candidateFunctions;
    }

    /**
     *
     * @param unknown $data
     * @return boolean|string $html
     */
    public function getDependencyTest($data)
    {
        if (empty($data->getDependency())) {
            return '';
        }

        /* Load Dependency */
        $this->loadDependencyService($data);

        $html = '';

        $dependency = $this->dependency->getTestInjections($data);

        foreach ($dependency as $item) {
            $html .= $this->getFileCreator()->renderPartial(
                'template/creator/dependency-test-partial.phtml',
                $item
            );
        }

        return $html;
    }
}
