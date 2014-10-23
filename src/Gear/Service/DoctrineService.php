<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\Module\ScriptService;

class DoctrineService extends ScriptService
{
    public function createFromTable($table)
    {
        echo $this->getOrmConvertMapping()."\n";
        echo $this->getOrmGenerateEntities()."\n";
        echo $this->getOrmSchemaToolUpdate()."\n";

    }

    public function createFromMetadata()
    {

    }
    /**
     * No final, deve possuir
     * 1 - Pasta src/$Module/Entity com as entidades
     * 3 - Banco de dados criado dentro da database passada como parametro
     */
    public function createEntityFromYml($module)
    {
        $this->ymlToEntity($module);
        $this->entityToDB();
    }

    /**
     * No final, deve possuir
     * 1 - Pasta $Module/src/$Module/Entity com as entidades e mapas
     * 3 - Banco de dados criado dentro da database passada como parametro
     */

    public function dbToAnnotations()
    {
        $module = $this->getModule();
        $b = '';
        $b .= 'vendor/doctrine/doctrine-module/bin/doctrine-module ';
        $b .= 'orm:convert-mapping --namespace="'.$module.'\\\Entity\\\" ';
        $b .= '--force  --from-database annotations module/'.$module.'/src/'.$module.'/Yml';

        $result = array();
        if ($this->getConfig()->getProject()=='gear') {
            exec($b, $result);
            $this->clearMapping();
        } else {
            echo $b."\n";
        }

        return $result;
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
        if ($this->getConfig()->getProject()=='gear') {
            exec($b, $result);
            $this->clearEntity();
        } else {
            echo $b."\n";
        }

        return $result;

    }

    public function clearSrcFolder()
    {
        $ymlFiles = realpath($this->getLocal().'/module/'.$this->getModule().'/src/');
        //echo $ymlFiles;die();

        foreach (glob($ymlFiles.'/*') as $i => $v) {

            $entity = explode('/',$v);

            if (end($entity)!==$this->getModule()) {
                $this->rmDir($v);
            }

        }
    }


    public function clearEntityFolder()
    {
        $ymlFiles = realpath($this->getLocal().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Yml/');
        foreach (glob($ymlFiles.'/'.$this->getModule().'.Entity.*.yml') as $i => $v) {
            $entity = explode('/',$v);
            $name = explode('.',end($entity));
            $entity_prefix = substr($name[2***REMOVED***, 0,3);

            //if ($entity_prefix !== $this->str('class',$this->getConfig()->getPrefix()) && $entity_prefix !== 'Kan') {
            if ($this->getConfig()->getPrefix()!==false) {
                if (($this->getConfig()->getPrefix()!='') && $entity_prefix !== $this->str('class',$this->getConfig()->getPrefix())) {
                    unlink($v);
                }
            }
        }
    }


    /**
     * Função responsável por gerar o comando de atualização do banco de dados
     * @return multitype:
     */
    public function getOrmSchemaToolUpdate()
    {
        return  'vendor/bin/doctrine-module orm:schema-tool:update --force';
    }

    public function getOrmConvertMapping()
    {
        $b = 'vendor/bin/doctrine-module ';
        $b .= sprintf('orm:convert-mapping --namespace="%s\\\Entity\\\" ', $this->getConfig()->getModule());
        $b .= sprintf('--force  --from-database annotations module/%s/src/%s/Entity', $this->getConfig()->getModule(), $this->getConfig()->getModule());

        return $b;

    }

    public function getOrmGenerateEntities()
    {
        $b = 'vendor/bin/doctrine-module orm:generate-entities';
        $b .= sprintf(' module/%s/src/ --generate-annotations=true', $this->getConfig()->getModule());

        return $b;
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
}
