<?php
namespace PiberNetwork\Form;

use PiberNetwork\Form\AbstractForm;
use Zend\Form\Element;

class PrecoTipoServicoForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('precoTipoServicoForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);


        $idPrecoTipoS = new Element('idPrecoTipoServico');
        $idPrecoTipoS->setAttributes(array(
            'name' => 'idPrecoTipoServico',
            'id' => 'idPrecoTipoServico',
            'type' => 'hidden',
        ));
        $idPrecoTipoS->setLabel(' Preco Tipo Servico');
        $this->add($idPrecoTipoS);
        $idTipoServico = array(
            'name' => 'idTipoServico',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' =>'  Tipo Servico',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'PiberNetwork\Entity\TipoServico',
                'property' => 'nome',
                'empty_option' => 'Escolher:',
            ),
        );
        $this->add($idTipoServico);
        $precoHora = new Element('precoHora');
        $precoHora->setAttributes(array(
            'name' => 'precoHora',
            'id' => 'precoHora',
            'type' => 'int',
        ));
        $precoHora->setLabel('Preco Hora');
        $this->add($precoHora);
        $dataInicio = new Element\Date('dataInicio');
        $dataInicio->setAttributes(array(
            'name' => 'dataInicio',
            'id' => 'dataInicio',
            'type' => 'date',
        ));
        $dataInicio->setFormat('d/m/Y');
        $dataInicio->setLabel('Data Inicio');
        $this->add($dataInicio);
        $dataFinal = new Element\Date('dataFinal');
        $dataFinal->setAttributes(array(
            'name' => 'dataFinal',
            'id' => 'dataFinal',
            'type' => 'date',
        ));
        $dataFinal->setFormat('d/m/Y');
        $dataFinal->setLabel('Data Final');
        $this->add($dataFinal);


        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
