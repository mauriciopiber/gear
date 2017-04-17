<?php
namespace Gear\Creator;

use GearJson\Controller\Controller;
//use GearJson\Src\Src;

class ClassObject
{
    private $name;
    
    private $namespace;
    
    private $dependency;
    
    private $moduleName;
    
    const FULL_NAME = '%s\%s';
    
    public function __construct($data, $module)
    {
        $this->moduleName = $module;
        $this->name = $data->getName();
        
        if (!empty($data->getNamespace())) {
            $namespace = ($data->getNamespace()[0***REMOVED*** != '\\') ? $module.'\\' : '';
        
        
            $namespace .= $data->getNamespace();
            $this->namespace = $namespace;
            
            //cria um diretório específico.
        } else {
            if ($data instanceof Controller) {
                $type = 'Controller';
            } elseif ($data->getType() == 'SearchForm') {
                $type = 'Form\\Search';
            } elseif ($data->getType() == 'ViewHelper') {
                $type = 'View\\Helper';
            } else {
                $type = $data->getType();
            }
            
            $this->namespace = $module.'\\'.$type;
        }
        
        if (!empty($data->getDependency())) {
            $this->addDependency($data->getDependency());
        }
        return $this;
    }
    
    public function addDependency(array $dependencies)
    {
        foreach ($dependencies as $i => $item) {
            $this->dependency[***REMOVED*** = new ClassDependencyObject($item, $this->moduleName, $i);
        }
        return $this;
    }
    
    public function getDependency()
    {
        return $this->dependency;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getNamespace()
    {
        return $this->namespace;
    }
    
    public function getAbsoluteFullName()
    {
        return '\\'.$this->getFullName();
    }
    
    public function getFullName()
    {
        return sprintf(self::FULL_NAME, $this->getNamespace(), $this->getName());
    }
}