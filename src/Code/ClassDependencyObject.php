<?php
namespace Gear\Code;

class ClassDependencyObject
{
    const FULL_NAME = '%s\%s';

    private $name;

    private $namespace;

    /**
     * Name to use used on local functions variables.
     */
    private $aliase;

    /**
     * Name to use on service manager.
     */
    //private $serviceManager;

    public function __construct($dependency, $module, $index = null)
    {

        $this->addAliase($dependency, $index);

        $this->addName($dependency);

        $this->addNamespace($dependency, $module);

        return $this;
    }

    public function addNamespace($dependency, $module)
    {
        //extract class name if is an array
        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            $dependency = $dependency['class'***REMOVED***;
        }

        $namespace = ($dependency[0***REMOVED*** != '\\') ? $module.'\\' : '';
        $dependency = ltrim($dependency, '\\');
        $extendsItem = explode('\\', $dependency);
        array_pop($extendsItem);
        $this->namespace = $namespace.implode('\\', $extendsItem);
        return $this;
    }

    public function addName($dependency)
    {
        $variable = (is_array($dependency) && isset($dependency['class'***REMOVED***)) ? $dependency['class'***REMOVED*** : $dependency;

        $fullname = explode('\\', $variable);
        $this->name = end($fullname);

        return $this;
    }

    public function addAliase($dependency, $index)
    {
        if (is_array($dependency)
            && isset($dependency['aliase'***REMOVED***)
            && !preg_match('#\\\\#', $dependency['aliase'***REMOVED***)
        ) {
            $this->aliase = $dependency['aliase'***REMOVED***;
        }

        if (is_string($index) && strlen($index) > 0) {
            $this->aliase = $index;
        }

        return $this;
    }

    public function getServiceManager()
    {
        if (isset($this->aliase) && !empty($this->aliase)) {
            return $this->aliase;
        }
        return $this->getFullName();
    }

    public function getVar()
    {
        if (isset($this->aliase) && !empty($this->aliase)) {
            return $this->aliase;
        }
        return $this->name;
    }

    public function getFullName()
    {
        return sprintf(self::FULL_NAME, $this->namespace, $this->name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }
}
