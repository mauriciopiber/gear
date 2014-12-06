<?php
namespace PiberNetwork\Form;

use PiberNetwork\Form\AbstractForm;
use Zend\Form\Element;

class CustoForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('custoForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);


        $idCusto = new Element('idCusto');
        $idCusto->setAttributes(array(
            'name' => 'idCusto',
            'id' => 'idCusto',
            'type' => 'hidden',
        ));
        $idCusto->setLabel(' Custo');
        $this->add($idCusto);
        $idStatusCusto = array(
            'name' => 'idStatusCusto',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' =>'  Status Custo',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'PiberNetwork\Entity\StatusCusto',
                'property' => 'nome',
                'empty_option' => 'Escolher:',
            ),
        );
        $this->add($idStatusCusto);
        $idTipoCusto = array(
            'name' => 'idTipoCusto',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' =>'  Tipo Custo',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'PiberNetwork\Entity\TipoCusto',
                'property' => 'nome',
                'empty_option' => 'Escolher:',
            ),
        );
        $this->add($idTipoCusto);
        $valor = new Element('valor');
        $valor->setAttributes(array(
            'name' => 'valor',
            'id' => 'valor',
            'type' => 'int',
        ));
        $valor->setLabel('Valor');
        $this->add($valor);
        $dataCusto = new Element\Date('dataCusto');
        $dataCusto->setAttributes(array(
            'name' => 'dataCusto',
            'id' => 'dataCusto',
            'type' => 'date',
        ));
        $dataCusto->setFormat('d/m/Y');
        $dataCusto->setLabel('Data Custo');
        $this->add($dataCusto);


        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
