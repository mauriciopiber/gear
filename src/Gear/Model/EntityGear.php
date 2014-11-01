<?php
namespace Gear\Model;
class EntityGear extends MakeGear
{

    public function clearMapping()
    {


    }



    public function clearEntity()
    {
        $ymlFiles = $this->getModule()->getSrcFolder();

        foreach (glob($ymlFiles.'/*') as $i => $v) {

            $entity = explode('/',$v);

            if (end($entity)!==$this->getConfig()->getModule()) {
                //$this->rmDir($v);
            }

        }
    }


}
