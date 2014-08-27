<?php
namespace Gear\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;

class ConfirmationForm extends Form
{
    public function __construct(EntityManager $em) {

        parent::__construct('SelectDb');
        $this->setAttribute('method', 'post');


        $yes = new Element('Yes');
        $yes->setAttributes(array(
            'type'  => 'submit',
            'class' => 'btn',
            'value' => '1'
        ));
        $yes->setLabel('Yes');
        $this->add($yes);

        $no = new Element('No');
        $no->setAttributes(array(
            'type'  => 'submit',
            'class' => 'btn',
            'value' => '2'
        ));
        $no->setLabel('No');
        $this->add($no);

    }

}