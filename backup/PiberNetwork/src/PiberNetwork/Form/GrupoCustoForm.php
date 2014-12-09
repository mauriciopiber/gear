<?php
namespace PiberNetwork\Form;

use PiberNetwork\Form\AbstractForm;
use Zend\Form\Element;

class GrupoCustoForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('grupoCustoForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);


        $idGrupoCusto = new Element('idGrupoCusto');
        $idGrupoCusto->setAttributes(array(
            'name' => 'idGrupoCusto',
            'id' => 'idGrupoCusto',
            'type' => 'hidden',
        ));
        $idGrupoCusto->setLabel(' Grupo Custo');
        $this->add($idGrupoCusto);
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
