<?php
namespace PiberNetwork\Form\Search;

use PiberNetwork\Form\AbstractForm;
use Zend\Form\Element;

class CustoSearchForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('tipoCustoSearchForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');
        $this->setAttribute('class', 'form-inline');

        $this->setEntityManager($entityManager);

        $idGropoCusto = array(
            'name' => 'idTipoCusto',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Tipo Custo',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'PiberNetwork\Entity\TipoCusto',
                'property' => 'nome',
                'empty_option' => 'Escolher:',
            ),
        );
        $this->add($idGropoCusto);

        $idStatusCusto = array(
            'name' => 'idStatusCusto',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Status Custo',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'PiberNetwork\Entity\StatusCusto',
                'property' => 'nome',
                'empty_option' => 'Escolher:',
            ),
        );
        $this->add($idStatusCusto);


        $dataCusto = new Element\Date('dataCustoPre');
        $dataCusto->setAttributes(array(
            'name' => 'dataCustoPre',
            'id' => 'dataCustoPre',
            'type' => 'date',
        ));
        $dataCusto->setFormat('d/m/Y');
        $dataCusto->setLabel('Data Custo de');
        $this->add($dataCusto);

        $dataCusto = new Element\Date('dataCustoPos');
        $dataCusto->setAttributes(array(
            'name' => 'dataCustoPos',
            'id' => 'dataCustoPos',
            'type' => 'date',
        ));
        $dataCusto->setFormat('d/m/Y');
        $dataCusto->setLabel('até');
        $this->add($dataCusto);

        $valor = new Element('valorPre');
        $valor->setAttributes(array(
            'name' => 'valorPre',
            'id' => 'valorPre',
            'type' => 'int',
        ));
        $valor->setLabel('Valor de');
        $this->add($valor);

        $valor = new Element('valorPos');
        $valor->setAttributes(array(
            'name' => 'valorPos',
            'id' => 'valorPos',
            'type' => 'int',
        ));
        $valor->setLabel('até');
        $this->add($valor);

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
