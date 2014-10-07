<?php
namespace Gear\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;

class CreateNewModuleInNewProjectForm extends Form
{
    public function __construct(EntityManager $em)
    {
        parent::__construct('SelectDb');
        $this->setAttribute('method', 'post');

        $name = new Element('Project Name');
        $name->setAttributes(array(
            'name' => 'project',
            'id' => 'project',
            'type' => 'text',
        ));
        $name->setLabel('Project Name');
        $this->add($name);

        $name = new Element('Module Name');
        $name->setAttributes(array(
            'name' => 'module',
            'id' => 'module',
            'type' => 'text',
        ));
        $name->setLabel('Module Name');
        $this->add($name);

        $name = new Element('Path');
        $name->setAttributes(array(
            'name' => 'path',
            'id' => 'path',
            'type' => 'text',
        ));
        $name->setLabel('Path');
        $this->add($name);

        $send = new Element('send');
        $send->setValue('Submit');
        $send->setAttributes(array(
            'type'  => 'submit',
            'class' => 'btn'
        ));
        $this->add($send);
    }

}
