<?php
namespace Gear\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;
class CreateModule extends Form
{
    public function __construct(EntityManager $em)
    {
        parent::__construct('create-module');
        $this->setAttribute('method', 'post');

        $name = new Element('ModuleName');
        $name->setAttributes(array(
            'name' => 'module',
            'id' => 'module',
            'type' => 'text',
        ));
        $name->setLabel('Module');
        $this->add($name);

        $send = new Element('send');
        $send->setValue('Submit');
        $send->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($send);
    }
}
