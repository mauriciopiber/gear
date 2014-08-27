<?php
namespace Gear\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;
class SelectTableForm extends Form
{
    
    private $em;
    
    public function setDb()
    {
       $selectDbForm = new SelectDbForm($this->em);
       foreach($selectDbForm as $element)
       {
            $element->setAttributes(array(
                'type' => 'hidden',
            ));
            $element->setLabel('');
           $this->add($element);
       }
    }
    
    public function setYml()
    {
        $selectYmlForm = new SelectYmlForm($this->em);
        foreach($selectYmlForm as $element)
        {
            $element->setAttributes(array(
                'type' => 'hidden',
            ));
            $element->setLabel('');
            $this->add($element);
        }
    }
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        
        parent::__construct('SelectDb');
        
        $this->setAttribute('method', 'post');

        $nome = new Element('module_name');
        $nome->setValue('Nome Módulo');
        $this->add($nome);
         
        $send = new Element('send');
        $send->setValue('Submit');
        $send->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($send);
    }


}