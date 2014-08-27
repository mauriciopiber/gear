<?php
namespace Gear\Model;
class EntityGear extends MakeGear
{


    public function __construct($adapter = null)
    {
    	parent::__construct($adapter);
    }

    public function setConfig(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }



    public function copyYml($module_name,$path,$namespace,$tables,$yml_path)
    {
        if(!is_dir($path))
        {
            return false;
        }
        $class = $this->toClass($module_name);

        $files = $this->getEntityFromFolder($path,$namespace);
        foreach($files as $filename)
        {
            $replace = false;
        	$name = $this->getEntityName($namespace,$filename);
        	if(in_array($name,$tables))
        	{
        	    $e_name = explode('/',$filename);

        	    $entity_name = end($e_name);

        	    $entity_map = explode('.',$entity_name);

        	    if($module_name!==$entity_map[0***REMOVED***)
        	    {
        	        $search  = $entity_map[0***REMOVED*** . '\\' . $entity_map[1***REMOVED***;
        	        array_shift($entity_map);
        	        $entity_name = $module_name.'.'.implode('.',$entity_map);
        	        $replace = $module_name. '\\' . $entity_map[0***REMOVED***;
        	        //var_dump($entity_name);
        	    }

        	    $cp_ds = $yml_path.'/'.$entity_name;
        	    copy($filename, $cp_ds);

        	    if($replace)
        	    {
        	        $yaml = file_get_contents($cp_ds);
        	        $new_yaml = str_replace($search, $replace, $yaml);
        	        file_put_contents($cp_ds, $new_yaml);
        	    }
        	}
        }
        return true;
    }

    public function getEntityName($namespace,$filename)
    {
        $full_name = explode('/',$filename);
        $explode_full = str_replace(trim($namespace).'.Entity.', '', end($full_name));
        $explode_full = str_replace('.dcm.yml', '', $explode_full);
        return $explode_full;
    }

    public function getEntityNames($namespace,$files)
    {
        //echo $namespace;die();
        $entity = array();
    	foreach($files as $filename)
    	{
    	    $entity[***REMOVED*** = $this->getEntityName($namespace,$filename);
    	}
    	return $entity;
    }

    public function getEntityFromFolder($path,$namespace)
    {
        $files = glob($path."/".$namespace.".*.dcm.yml");
        return $files;
    }
    /**
     * No final, deve possuir
     * 1 - Pasta src/$Module/Entity com as entidades
     * 2 - Pasta src/$Module/yml com os modelos
     * 3 - Banco de dados criado dentro da database passada como parametro
     */
    public function createEntityFromYml($module)
    {
    	$this->ymlToEntity($module);
    	$this->entityToDB();
    }

    /**
     * No final, deve possuir
     * 1 - Pasta $Module/src/$Module/Entity com as entidades
     * 2 - Pasta $Module/src/$Module/Yml com os mapeamentos
     * 3 - Banco de dados criado dentro da database passada como parametro
     */

    public function dbToAnnotations()
    {
        $module = $this->getModule();
        $b = '';
        $b .= 'vendor/doctrine/doctrine-module/bin/doctrine-module ';
        $b .= 'orm:convert-mapping --namespace="'.$module.'\\\Entity\\\" ';
        $b .= '--force  --from-database yml module/'.$module.'/src/'.$module.'/Yml';


        $result = array();
        if($this->getConfig()->getProject()=='gear') {
            exec($b, $result);
            $this->clearMapping();
        } else {
            echo $b."\n";
        }
        return $result;
    }

    public function clearMapping()
    {
        $ymlFiles = realpath($this->getLocal().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Yml/');
        foreach(glob($ymlFiles.'/'.$this->getModule().'.Entity.*.yml') as $i => $v) {
            $entity = explode('/',$v);
            $name = explode('.',end($entity));
            $entity_prefix = substr($name[2***REMOVED***, 0,3);

            //if($entity_prefix !== $this->str('class',$this->getConfig()->getPrefix()) && $entity_prefix !== 'Kan') {
            if($this->getConfig()->getPrefix()!==false) {
	            if(($this->getConfig()->getPrefix()!='') && $entity_prefix !== $this->str('class',$this->getConfig()->getPrefix())) {
	            	unlink($v);
	            }
            }
        }

    }

    public function annotationsToEntity($module)
    {
        $module = $this->str('class',$module);
        $b = '';
        $b .= 'vendor/doctrine/doctrine-module/bin/doctrine-module orm:generate-entities';
        $b .= ' module/'.$module.'/src/ --generate-annotations=true';

        echo $b."\n";
        $result = array();
        //exec($b, $result);
        return $result;
    }

    public function ymlToEntity()
    {
        $b = '';
        $b .= 'vendor/doctrine/doctrine-module/bin/doctrine-module orm:generate-entities  --generate-annotations=1 module/'.$this->getModule().'/src/ ';
        //echo $b."\n";
        $result = array();
        if($this->getConfig()->getProject()=='gear') {
            exec($b, $result);
             $this->clearEntity();
        } else {
            echo $b."\n";
        }
        return $result;

    }

    public function clearEntity()
    {
        $ymlFiles = realpath($this->getLocal().'/module/'.$this->getModule().'/src/');
        //echo $ymlFiles;die();

        foreach(glob($ymlFiles.'/*') as $i => $v) {

            $entity = explode('/',$v);

            if(end($entity)!==$this->getModule()) {
                $this->rmDir($v);
            }

        }
    }

    public function entityToDB()
    {
        $b = '';
        $b .= 'vendor/bin/doctrine-module orm:schema-tool:update --force';
        $result = array();
        exec($b, $result);
        var_dump($result);
        return $result;
    }

    public function ymlToDB()
    {
        //metodo direto
    }

    public function dbToYml()
    {

    }

    public function entityToYml()
    {

    }

}