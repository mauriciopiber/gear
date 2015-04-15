<?php
namespace Teste\Form;

use Teste\Form\AbstractForm;
use Zend\Form\Element;

class EmailForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('emailForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);

        $idEmail = new Element('idEmail');
        $idEmail->setLabel('Email');
        $idEmail->setAttributes(array(
            'name' => 'idEmail',
            'id' => 'idEmail',
            'type' => 'hidden',
        ));
        $this->add($idEmail);

        $remetente = new Element('remetente');
        $remetente->setLabel('Remetente');
        $remetente->setAttributes(array(
            'name' => 'remetente',
            'id' => 'remetente',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $this->add($remetente);

        $destino = new Element('destino');
        $destino->setLabel('Destino');
        $destino->setAttributes(array(
            'name' => 'destino',
            'id' => 'destino',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $this->add($destino);

        $assunto = new Element('assunto');
        $assunto->setLabel('Assunto');
        $assunto->setAttributes(array(
            'name' => 'assunto',
            'id' => 'assunto',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $this->add($assunto);

        $mensagem = new Element('mensagem');
        $mensagem->setLabel('Mensagem');
        $mensagem->setAttributes(array(
            'name' => 'mensagem',
            'id' => 'mensagem',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $this->add($mensagem);

        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
