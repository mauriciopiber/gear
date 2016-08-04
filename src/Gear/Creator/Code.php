<?php
namespace Gear\Creator;

use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\App\App;
use Gear\Creator\FileExtendsInterface;
use Gear\Creator\FileUseAttributeInterface;
use Gear\Creator\FileUseInterface;

class Code extends AbstractCode implements
    FileExtendsInterface,
    FileUseAttributeInterface,
    FileUseInterface
{
    static protected $defaultLocation;

    static protected $defaultNamespace;

    /**
     * Retorna os parametros que são usados como argumento no construtor dentro da Classe.
     */
    public function getConstructorArguments($data)
    {
        $args = [***REMOVED***;

        $dependency = $data->getDependency();

        foreach ($dependency as $dependency) {
            $fullname = explode('\\', $dependency[0***REMOVED***);
            $name = end($fullname);

            $args[***REMOVED*** = $this->str('class', $name).' $'.$this->str('var-lenght', $name);
        }

        return $args;
    }

    public function getFactoryServiceLocator($src)
    {
        if (empty($src->getDependency())) {
            return '';

        }
        $ndnt = str_repeat(' ', 4*3);

        $template = '$serviceLocator->get(\'%s\')';

        $text = '';

        foreach ($src->getDependency() as $i => $dependency) {

            $text .= $ndnt;
            $text .= sprintf($template, $this->resolveNamespace($dependency));
            if (isset($src->getDependency()[$i+1***REMOVED***)) {
                $text .= ',';
            }
            $text .= PHP_EOL;
        }

        return $text;
    }

    public function getInterfaceUse($data)
    {
        if (empty($data->getExtends()) && empty($data->getDependency())) {
            return '';
        }

        $this->uses = '';

        if ($data->getExtends() !== null) {
            $this->uses .= 'use '.$this->resolveNamespace($data->getExtends()).';'.PHP_EOL;
        }

        if (!empty($data->getDependency())) {
            foreach ($data->getDependency() as $alias => $item) {
                $this->uses .= 'use '.$this->resolveNamespace($item).';'.PHP_EOL;
            }
        }

        return $this->uses.PHP_EOL;
    }

    public function getInterfaceDependency($data)
    {
        $template = <<<EOS
    public function set%s(%s \$%s);

    public function get%s();

EOS;

        if (empty($data->getDependency())) {
            return PHP_EOL;
        }

        $html = '';

        foreach ($data->getDependency() as $i => $dependency) {
            $class = $this->str('class', $this->resolveName($dependency));
            $var = $this->str('var', $class);
            $html .= sprintf($template, $class, $class, $var, $class);
            if (isset($data->getDependency()[$i+1***REMOVED***)) {
                $html .= PHP_EOL;
            }
        }

        return $html;
    }

    /**
     * Retorna as atribuições dos argumentos nas variáveis dentro da Classe.
     */
    public function getConstructorParams($data)
    {
        $args = [***REMOVED***;

        $dependency = $data->getDependency();

        foreach ($dependency as $dependency) {
            $fullname = explode('\\', $dependency[0***REMOVED***);
            $name = end($fullname);

            $args[***REMOVED*** = '$this->'.$this->str('var', $name).' = $'.$this->str('var-lenght', $name);
        }

        return $args;
    }

    /**
     * Retorna as chamadas das dependências utiilzando o serviceLocator dentro da Factory.
     * Diferença entre Service/Controller.
     */
    public function getConstructorServiceLocator($data)
    {
        $args = [***REMOVED***;

        $dependency = $data->getDependency();

        foreach ($dependency as $dependency) {
            $fullname = explode('\\', $dependency[0***REMOVED***);
            $name = end($fullname);

            if ($data instanceof Controller) {
                $fullname = explode('\\', $dependency[0***REMOVED***);
                $name = end($fullname);
                array_pop($fullname);

                $serviceName = $this->getModule()->getModuleName().'\\';
                $serviceName .= implode('\\', $fullname).'\\';
                $serviceName .= $name;

                $args[***REMOVED*** = '$'.$this->str('var', $name).' = $serviceLocator'.PHP_EOL
                .'->getServiceLocator()'.PHP_EOL
                .'->get(\''.$serviceName.'\')'.PHP_EOL;
            } else {
            }
        }

        return $args;
    }

    /**
     * Retorna a sequência de variáveis que é passada para o constructor dentro da Factory.
     */
    public function getConstructorFactoryArguments($data)
    {
        $args = [***REMOVED***;

        $dependency = $data->getDependency();

        foreach ($dependency as $dependency) {
            $fullname = explode('\\', $dependency[0***REMOVED***);
            $name = end($fullname);

            if ($data instanceof Controller) {
                $fullname = explode('\\', $dependency[0***REMOVED***);
                $name = end($fullname);

                $args[***REMOVED*** = '$'.$this->str('var', $name);
            }
        }

        return $args;
    }

    public function getExtends($data)
    {
        if ($data->getExtends() === null) {
            if ($data instanceof Controller) {
                if ($this->str('class', $data->getType()) == 'Action') {
                    return 'AbstractActionController';
                }

                if ($this->str('class', $data->getType()) == 'Console') {
                    return 'AbstractConsoleController';
                }
            }

            return null;
        }

        $extendsItem = explode('\\', $data->getExtends());
        return end($extendsItem);
    }

    public function getNamespace($data)
    {
        if (!empty($data->getNamespace())) {
            $namespace = ($data->getNamespace()[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';


            $namespace .= $data->getNamespace();
            return $namespace;
            //cria um diretório específico.
        }

        if ($data->getType() == 'SearchForm') {
            $type = 'Form\\Search';
        } elseif ($data->getType() == 'ViewHelper') {
            $type = 'View\\Helper';
        } else {
            $type = $data->getType();
        }

        return $this->getModule()->getModuleName().'\\'.$type;
    }


    public function getLocationPath($data)
    {
        if ($data instanceof Src || $data instanceof Controller) {
            //$namespace = ($data->getNamespace()[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';
            $psr = explode('\\', $data->getNamespace());


            $dirNamespace = implode('/', $psr);

            $this->getDirService()->mkDeepDir($dirNamespace, $this->getModule()->getSrcModuleFolder());

            $location = $this->getModule()->getSrcModuleFolder().'/'.$dirNamespace;

            $this->getDirService()->mkDir($location);

            return $location;
        }

        if ($data instanceof App) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $this->str('var', $item);
            }

            $dirNamespace = implode('/', $psr);

            $this->getDirService()->mkDeepDir($dirNamespace, $this->getModule()->getPublicJsAppFolder());

            $location = $this->getModule()->getPublicJsAppFolder().'/'.$dirNamespace;

            echo $location."\n";
            $this->getDirService()->mkDir($location);
            return $location;
        }
    }

    public function getLocation($data)
    {
        /* Load Dependency */
        //$this->loadDependencyService($data);

        if (!empty($data->getNamespace())) {
            $location = $this->getLocationPath($data);



            return $location;
        }


        $type = $this->str('class', $data->getType());

        if ($data instanceof App) {
            $type = 'App'.$type;
        }

        return $this->getModule()->map($type);
    }


    /**
     * Retorna o nome completo que consiste no Namespace + Nome.
     */
    public function getClassName($data)
    {
        $namespace = '';

        if ($data instanceof Src) {
            if (empty($data->getNamespace())) {
                if ($data->getType() == 'SearchForm') {
                    $type = 'Form\\Search';
                } else {
                    $type = $data->getType();
                }

                return $this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName();
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName();
        }

        if ($data instanceof Controller) {
            if (empty($data->getNamespace())) {
                $type = 'Controller';
                return $this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName();
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName();
        }

        if ($data instanceof Action) {
            $controller = $data->getController();

            if ($data->getDb() === null) {
                $name = $controller->getName();
            } else {
                $name = $controller->getNameOff();
            }


            if (empty($controller->getNamespace())) {
                $type = 'Controller';
                return $this->getModule()->getModuleName().'\\'.$type.'\\'.$name;
            }

            $namespace = ($controller->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $controller->getNamespace().'\\'.$name;
        }

        return $namespace;
    }


    public function classNameToNamespace($data)
    {
        $namespace = '';

        if ($data instanceof Src) {
            if (empty($data->getNamespace())) {
                if ($data->getType() == 'SearchForm') {
                    $type = 'Form\\Search';
                } else {
                    $type = $data->getType();
                }

                return 'use '.$this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName().';'.PHP_EOL;
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName().';'.PHP_EOL;
        }

        if ($data instanceof Controller) {
            if (empty($data->getNamespace())) {
                $type = 'Controller';
                return 'use '.$this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName().';'.PHP_EOL;
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName().';'.PHP_EOL;
        }


        return 'use '.$namespace;
    }


    /**
     * Função padrão para criar Constructors.
     *
     * @param Src $data
     */
    public function getConstructor($data)
    {
        $dependency = [***REMOVED***;

        if (!empty($data->getDependency())) {
            foreach ($data->getDependency() as $item) {
                $fullname = explode('\\', $item);
                $name = end($fullname);
                $dependency[***REMOVED*** = $name;
            }
        }

        $html = '    public function __construct(';

        if (count($dependency)==0) {
            $html .= ')'.PHP_EOL;
            $html .= '    {'.PHP_EOL.PHP_EOL.'    }'.PHP_EOL;

            return $html;
        }

        $howManyDep = count($dependency);

        $args = '';
        $attr = '';

        foreach ($dependency as $i => $item) {
            if ($howManyDep > 1) {
                $args .= '        ';
            }

            $args .= $this->str('class', $item).' $'.$this->str('var', $item);

            if ($howManyDep > 1) {
                if (isset($dependency[$i+1***REMOVED***)) {
                    $args .= ',';
                }

                $args .= PHP_EOL;
            }

            $attr .= '        $this->'.$this->str('var', $item).' = $'.$this->str('var', $item).';';

            if ($howManyDep > 1) {
                $attr .= PHP_EOL;
            }
        }

        if ($howManyDep > 1) {
            $html .= PHP_EOL;
        }

        $html .= $args;

        if ($howManyDep > 1) {
            $html .= '    ) {'.PHP_EOL;
        } else {
            $html .= ')'.PHP_EOL.'    {'.PHP_EOL;
        }

        $html .= $attr;

        if ($howManyDep > 1) {
            $html .= '    }'.PHP_EOL;
        } else {
            $html .= PHP_EOL.'    }'.PHP_EOL;
        }

        return $html;
    }

    public function getUse($data, array $include = null, array $implements = null)
    {
        /* Load Dependency */

        $this->loadDependencyService($data);

        $this->uses = '';

        if ($data instanceof Src && !empty($data->getImplements())) {
            foreach ($data->getImplements() as $alias => $item) {
                $this->uses .= 'use '.$this->resolveNamespace($item).';'.PHP_EOL;
            }
        }

        $this->uses .= $this->dependency->getUseNamespace(false);

        if ($data->getExtends() !== null) {
            $this->uses .= 'use '.$this->resolveNamespace($data->getExtends()).';'.PHP_EOL;
        }

        if ($data->getExtends() == null && $data instanceof Controller) {
            if ($this->str('class', $data->getType()) == 'Action') {
                $this->uses .= 'use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL;
            }

            if ($this->str('class', $data->getType()) == 'Console') {
                $this->uses .= 'use Zend\Mvc\Controller\AbstractConsoleController;'.PHP_EOL;
            }
        }

        if (!empty($data->getDependency()) && $data->getService() === 'factories') {
            foreach ($data->getDependency() as $alias => $item) {
                $this->uses .= 'use '.$this->resolveNamespace($item).';'.PHP_EOL;
            }
        }

        if (!empty($include)) {
            foreach ($include as $alias => $item) {
                if (!is_int($alias)) {
                    $this->uses .= 'use '.$item.' as '.$alias.';'.PHP_EOL;
                    continue;
                }
                $this->uses .= 'use '.$item.';'.PHP_EOL;
            }
        }

        if (!empty($implements)) {
            foreach ($implements as $alias => $item) {
                $this->uses .= 'use '.$this->resolveNamespace($item).';'.PHP_EOL;
            }
        }

        if (!empty($this->uses)) {
            $this->uses .= PHP_EOL;
        }
        return $this->uses;
    }

    public function extractNamesFromNamespaceArray(array $extract)
    {
        foreach ($extract as $name => $item) {
            if (!is_int($name)) {
                $data[***REMOVED*** = $name;
                continue;
            }

            $names = explode('\\', $item);
            $data[***REMOVED*** = end($names);
        }

        $html = '';

        if (count($data)>1) {
            $separator = '    ';
            $html .= PHP_EOL;
        } else {
            $separator = ' ';
        }


        foreach ($data as $i => $item) {
            $html .= $separator.$item;


            if (isset($data[$i+1***REMOVED***)) {
                $html .= ',';
            }

            $html .= PHP_EOL;
        }

        return $html;
    }

    public function getImplements($data, array $additional)
    {
        if (empty($data->getImplements()) && empty($additional)) {
            return PHP_EOL;
        }

        if ($data->getImplements() === null) {
            $imp = [***REMOVED***;
        } else {
            $imp = $data->getImplements();
        }

        $implements = array_merge($additional, $imp);



        $html = ' implements';

        $html .= $this->extractNamesFromNamespaceArray($implements);

        return $html;
    }


    public function getUseAttribute($data, array $include = null)
    {
        /* Load Dependency */
        $this->loadDependencyService($data);

        $attributes = $this->dependency->getUseAttribute(false);

        if (!empty($include)) {
            foreach ($include as $name => $item) {
                if (!is_int($name)) {
                    $attributes .= '    use '.$name.';'.PHP_EOL;
                    continue;
                }

                $names = explode('\\', $item);

                $attributes .= '    use '.end($names).';'.PHP_EOL;
            }
        }

        return $attributes;
    }
}
