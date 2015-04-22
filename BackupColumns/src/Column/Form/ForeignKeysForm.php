<?php
namespace Column\Form;

use Column\Form\AbstractForm;
use Zend\Form\Element;

class ForeignKeysForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('foreignKeysForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);

        $idForeignKeys = new Element('idForeignKeys');
        $idForeignKeys->setLabel('Foreign Keys');
        $idForeignKeys->setAttributes(array(
            'name' => 'idForeignKeys',
            'id' => 'idForeignKeys',
            'type' => 'hidden',
        ));
        $this->add($idForeignKeys);

        $name = new Element('name');
        $name->setLabel('Name');
        $name->setAttributes(array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $this->add($name);

        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
