<?php
namespace PiberNetwork\Form;

use PiberNetwork\Form\AbstractForm;
use Zend\Form\Element;

class TipoServicoForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('tipoServicoForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);


        $idTipoServico = new Element('idTipoServico');
        $idTipoServico->setAttributes(array(
            'name' => 'idTipoServico',
            'id' => 'idTipoServico',
            'type' => 'hidden',
        ));
        $idTipoServico->setLabel(' Tipo Servico');
        $this->add($idTipoServico);
        $nome = new Element('nome');
        $nome->setAttributes(array(
            'name' => 'nome',
            'id' => 'nome',
            'type' => 'text',
        ));
        $nome->setLabel('Nome');
        $this->add($nome);
        $descricao = new Element('descricao');
        $descricao->setAttributes(array(
            'name' => 'descricao',
            'id' => 'descricao',
            'type' => 'textarea',
        ));
        $descricao->setLabel('Descricao');
        $this->add($descricao);


        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
