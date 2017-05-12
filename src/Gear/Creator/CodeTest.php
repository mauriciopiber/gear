<?php
namespace Gear\Creator;

use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\App\App;
use Gear\Creator\Codes\CodeTest\AbstractCodeTest;

class CodeTest extends AbstractCodeTest
{
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
            $template .= sprintf(
                $defTemplate,
                $this->extractVar($dependency, $src),
                $this->resolveNamespace($dependency)
            );

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
            $template .= $ndnt.sprintf(
                $defTemplate,
                $this->extractVar($dependency, $src),
                $this->resolveNamespace($dependency)
            ).PHP_EOL;
        }

        return $template;
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

    public function getTests($data)
    {
        if ($data->hasDependency() == null) {
            return '';
        }


        $dependencies = $data->getDependency();

        $valid = [***REMOVED***;

        foreach ($dependencies as $dependency) {
            $srcName = $this->extractSrcNameFromDependency($dependency);
            $srcType = $this->extractSrcTypeFromDependency($dependency);

            $factoryName = $this->getModule()->getModuleName().'\\'.$srcType.'\\'.$srcName;


            if (!in_array($factoryName, $valid)) {
                $valid[***REMOVED*** = $factoryName;
            }
        }

        return $valid;
    }

    public function getDependencyToInject($data, $lines)
    {
        if (empty($data->getDependency())) {
            return false;
        }

        $this->uses = $this->getTests($data);

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
