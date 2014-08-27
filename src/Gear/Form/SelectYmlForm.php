<?php
namespace Gear\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;
class SelectYmlForm extends Form
{
    public function __construct(EntityManager $em)
    {
        parent::__construct('SelectYml');
        $this->setAttribute('method', 'post');


        $name = new Element('username');
        $name->setAttributes(array(
            'name' => 'username',
            'id' => 'username',
            'type' => 'text',
        ));
        $name->setLabel('Username');
        $this->add($name);

        $password = new Element('password');
        $password->setAttributes(array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
        ));
        $password->setLabel('Password');

        $this->add($password);
        
        $address = new Element('database');
        $address->setAttributes(array(
            'name' => 'database',
            'id' => 'database',
            'type' => 'text',
        ));
        $address->setLabel('Database');
        
        $this->add($address);
        
        
        $dbms = new Element\Select('driver');
        $dbms->setAttributes(array(
            'name' => 'driver',
            'id' => 'driver',
            'type' => 'select',
        ));
        $dbms->setOptions(array('value_options' => array('Mysqli' => 'Mysql')));
        $dbms->setLabel('Driver');
        
        $this->add($dbms);
        
        $path = new Element('module_name');
        $path->setAttributes(array(
            'name' => 'module_name',
            'id' => 'module_name',
            'type' => 'text',
        ));
        $path->setLabel('Nome Módulo');
        $this->add($path);
        
        $path = new Element('path');
        $path->setAttributes(array(
            'name' => 'path',
            'id' => 'path',
            'type' => 'text',
        ));
        $path->setLabel('Localização do Arquivo Yml');
        $this->add($path);
        
        $path = new Element('yml');
        $path->setAttributes(array(
            'name' => 'yml',
            'id' => 'yml',
            'type' => 'text',
        ));
        $path->setLabel('Yml Namespace');
        $this->add($path);

        $send = new Element('send');
        $send->setValue('Submit');
        $send->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($send);
    }
    


}