<?php
namespace PiberNetwork\Form;

use PiberNetwork\Form\AbstractForm;
use Zend\Form\Element;

class TipoCustoForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('tipoCustoForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);


        $idTipoCusto = new Element('idTipoCusto');
        $idTipoCusto->setAttributes(array(
            'name' => 'idTipoCusto',
            'id' => 'idTipoCusto',
            'type' => 'hidden',
        ));
        $idTipoCusto->setLabel(' Tipo Custo');
        $this->add($idTipoCusto);
        $idGropoCusto = array(
            'name' => 'idGrupoCusto',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' =>'  Gropo Custo',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'PiberNetwork\Entity\GrupoCusto',
                'property' => 'nome',
                'empty_option' => 'Escolher:',
            ),
        );
        $this->add($idGropoCusto);
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
