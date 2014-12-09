<?php
namespace PiberNetwork\Form;

use PiberNetwork\Form\AbstractForm;
use Zend\Form\Element;

class StatusCustoForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('statusCustoForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);


        $idStatusCusto = new Element('idStatusCusto');
        $idStatusCusto->setAttributes(array(
            'name' => 'idStatusCusto',
            'id' => 'idStatusCusto',
            'type' => 'hidden',
        ));
        $idStatusCusto->setLabel(' Status Custo');
        $this->add($idStatusCusto);
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
