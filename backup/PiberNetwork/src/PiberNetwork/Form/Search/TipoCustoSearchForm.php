<?php
namespace PiberNetwork\Form\Search;

use PiberNetwork\Form\AbstractForm;
use Zend\Form\Element;

class TipoCustoSearchForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('tipoCustoSearchForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');
        $this->setAttribute('class', 'form-inline');

        $this->setEntityManager($entityManager);


        $idGropoCusto = array(
            'name' => 'idGrupoCusto',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' =>'  Grupo Custo ',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'PiberNetwork\Entity\GrupoCusto',
                'property' => 'nome',
                'empty_option' => 'Escolher:',
            ),
        );
        $this->add($idGropoCusto);


        $nome = new Element('likeField');
        $nome->setAttributes(array(
            'name' => 'likeField',
            'id' => 'likeField',
            'type' => 'text',
        ));
        $nome->setLabel('Palavra Chave ');
        $this->add($nome);


        $submit = new Element('submit');
        $submit->setValue('Pesquisar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);

        $submit = new Element('clear');
        $submit->setValue('Limpar');
        $submit->setAttributes(array(
            'type'  => 'button'
        ));
        $this->add($submit);
    }
}
