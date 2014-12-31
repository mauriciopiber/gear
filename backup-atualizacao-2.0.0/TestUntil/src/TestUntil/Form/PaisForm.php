<?php
namespace TestUntil\Form;

use TestUntil\Form\AbstractForm;
use Zend\Form\Element;

class PaisForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('paisForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);


        $idPais = new Element('idPais');
        $idPais->setAttributes(array(
            'name' => 'idPais',
            'id' => 'idPais',
            'type' => 'hidden',
        ));
        $idPais->setLabel('Pais');
        $this->add($idPais);

        $nome = new Element('nome');
        $nome->setAttributes(array(
            'name' => 'nome',
            'id' => 'nome',
            'type' => 'text',
        ));
        $nome->setLabel('Nome');
        $this->add($nome);



        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
