<?php
namespace Gear\Creator;

use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\App\App;

class CodeTest extends AbstractCode
{

    public function extractServiceManagerFromDependency($dependency, $i)
    {
        if (is_string($i) && strlen($i) > 0) {
            return $i;
        }

        if (is_array($dependency) && isset($dependency['aliase'***REMOVED***)) {
            return $dependency['aliase'***REMOVED***;
        }

        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            return $this->resolveNamespace($dependency['class'***REMOVED***);
        }

        return $this->resolveNamespace($dependency);
    }

    public function getServiceManagerDependencies($src)
    {
        if (empty($src->getDependency())) {
            return '';
        }

        $template = <<<EOS
        \$this->serviceLocator->get('%s')
            ->willReturn(\$this->prophesize('%s')->reveal())
            ->shouldBeCalled();
EOS;

        $msg = PHP_EOL;

        $alldep = count($src->getDependency());

        foreach ($src->getDependency() as $i => $dependency) {
            $alldep -= 1;

            $fullname = $this->resolveNamespace($dependency);
            $variable = $this->extractServiceManagerFromDependency($dependency, $i);

            $msg .= sprintf($template, $variable, $fullname);
            $msg .= PHP_EOL;
            if (is_integer($i) && isset($src->getDependency()[$i+1***REMOVED***) || $alldep > 0) {
                $msg .= PHP_EOL;
            }
        }

        return $msg;
    }

    public function getConstructor($src)
    {
        if ($src instanceof Controller) {
            $names = 'controller';
        } else {
            $names = $this->str('var', $src->getType());
        }


        $template = '';

        $open = '$this->%s = new %s(';

        $ndnt = str_repeat(' ', 4*2);
        $template .= $ndnt.sprintf($open, $names, $this->str('class', $src->getName()));


        if (empty($src->getDependency())) {
            $template .= ');'.PHP_EOL;
            return $template;
        }

        $template .= PHP_EOL;

        $ndnt = str_repeat(' ', 4*3);

        $defTemplate = '$this->%s->reveal()';

        $count = count($src->getDependency());
        $iterator = 0;

        foreach ($src->getDependency() as $i => $dependency) {
            $template .= $ndnt;
            $template .= sprintf($defTemplate, $this->extractVar($dependency, $src));
            $template .= ($iterator < $count-1) ? ',' : '';
            $template .= PHP_EOL;

            $iterator += 1;
        }

        $ndnt = str_repeat(' ', 4*2);
        $template .= $ndnt.');'.PHP_EOL;

        return $template;
    }

    public function extractVar($dependency, $data = null)
    {
        if (is_array($dependency) && isset($dependency['aliase'***REMOVED***) && !preg_match('#\\\\#', $dependency['aliase'***REMOVED***)) {
            $dependency = $dependency['aliase'***REMOVED***;
        }

        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            $dependency = $dependency['class'***REMOVED***;
        }

        $allNames = explode('\\', $dependency);
        $name = end($allNames);

        if ($data !== null && $data->getDb() !== null) {
            if (preg_match('/[a-zA-Z***REMOVED****Repository/', $dependency, $matches) === 1) {
                return $this->str('var', 'repository');
            }

            if (preg_match('/Memcached/', $dependency, $matches) === 1) {
                return $this->str('var', 'cache');
            }
        }

        return $this->str('var', $name);
    }

    public function getDependencyReveal($src)
    {
        if (empty($src->getDependency())) {
            return '';
        }

        $template = '';

        $ndnt = str_repeat(' ', 4*3);

        $defTemplate = '$this->%s->reveal()';

        foreach ($src->getDependency() as $i => $dependency) {
            $template .= $ndnt;
            $template .= sprintf($defTemplate, $this->extractVar($dependency, $src), $this->resolveNamespace($dependency));

            if (isset($src->getDependency()[$i+1***REMOVED***)) {
                $template .= ',';
            }
            $template .= PHP_EOL;
        }

        return $template;
    }

    public function getConstructorDependency($src)
    {
        if (empty($src->getDependency())) {
            return '';
        }

        $ndnt = str_repeat(' ', 4*2);

        $defTemplate = '$this->%s = $this->prophesize(\'%s\');';

        $template = PHP_EOL;

        foreach ($src->getDependency() as $dependency) {
            $template .= $ndnt.sprintf($defTemplate, $this->extractVar($dependency, $src), $this->resolveNamespace($dependency)).PHP_EOL;
        }

        return $template;
    }

    public function getTestNamespace($data)
    {
        if (!empty($data->getNamespace())) {
            $namespace = $data->getNamespace();
            return $namespace;
        }

        if ($data instanceof Controller) {
            return 'Controller';
        }

        if ($data->getType() == 'SearchForm') {
            return 'Form\Search';
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
                if ($data->getType() == 'SearchForm') {
                    $namespace = 'Form\Search';
                } else {
                    $namespace = $data->getType();
                }
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
            if ($data->getType() == 'SearchForm') {
                return 'FormTest\SearchTest';
            }
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

        if ($data instanceof Controller) {
            $type = 'Controller';
        } else {
            $type = $this->str('class', $data->getType());
        }

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
}
