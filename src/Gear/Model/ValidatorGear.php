<?php

namespace Gear\Model;
use Zend\Db\Adapter\Adapter;


class ValidatorGear extends MakeGear
{

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/public/js';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        if(is_array($entities) && count($entities)>0) {

            //foreach($entities as $i => $table) {
                //echo 'Iniciando criação do '.$this->str('label',$this->getFileName($table)).'Controller '."\n";
                $this->createValidationFromEntities($entities);
            //}
        } else {
            return false;
        }
    }

    public function createValidationFromEntities($entities) {

        $js = $this->powerLine(0,'$(function() {');

        foreach($entities as $i => $v) {

            $columns = $this->getColumns($v);

            $js .= $this->powerLine(1,'var validator = $("#%s").validate({',$this->str('class',$v));
            $js .= $this->powerLine(2,'rules : {');
            foreach($columns as $a => $b) {
                if(!in_array($b->name,$this->getConfig()->getDbException()) & !$b->pk && !$b->nl) {
                    $js .= $this->powerLine(3,'%s : "required",',$this->str('var',$b->name));
                }
            }
            $js .= $this->powerLine(2,'},');

            $js .= $this->powerLine(2,'messages : {');
            foreach($columns as $a => $b) {
                if(!in_array($b->name,$this->getConfig()->getDbException()) & !$b->pk && !$b->nl) {
                    $js .= $this->powerLine(3,'%s : "Informe o %s do %s",',
                        array($this->str('var',$b->name),$this->str('label',$b->name),$this->str('label',$v))
                    );
                }
            }
            $js .= $this->powerLine(2,'},');

            $js .= $this->powerLine(2,'errorPlacement : errorPlacement,');
            $js .= $this->powerLine(2,'submitHandler : submitHandler,');
            $js .= $this->powerLine(2,'success : success,');
            $js .= $this->powerLine(2,'highlight : highlight');



            $js .= $this->powerLine(1,'});',array(),true);

        }

        $js .= $this->powerLine(0,'});',array(),true);


        $js .= $this->powerLine(0,'var errorPlacement = function(error, element) {');
        $js .= $this->powerLine(1,'    error.appendTo(element.parent());');
        $js .= $this->powerLine(0,'};');
        $js .= $this->powerLine(0,'// specifying a submitHandler prevents the default submit, good');
        $js .= $this->powerLine(0,'// for the demo');
        $js .= $this->powerLine(0,'var submitHandler = function(form) {');
        $js .= $this->powerLine(1,'    form.submit();');
        $js .= $this->powerLine(1,'    //alert("submitted!");');
        $js .= $this->powerLine(0,'};');
        $js .= $this->powerLine(0,'// set this class to error-labels to indicate valid fields');
        $js .= $this->powerLine(0,'var success = function(label) {');
        $js .= $this->powerLine(1,'    // set &nbsp; as text for IE');
        $js .= $this->powerLine(1,'    label.html("&nbsp;").addClass("checked");');
        $js .= $this->powerLine(0,'};');
        $js .= $this->powerLine(0,'var highlight = function(element, errorClass) {');
        $js .= $this->powerLine(1,'    $(element).parent().next().find("." + errorClass)');
        $js .= $this->powerLine(1,'    .removeClass("checked");');
        $js .= $this->powerLine(0,'};');

        $this->mkJs($this->getFinalPath(), 'validator', $js);


    }
}