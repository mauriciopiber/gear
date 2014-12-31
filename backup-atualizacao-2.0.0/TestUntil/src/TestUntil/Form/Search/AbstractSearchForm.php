<?php
namespace TestUntil\Form\Search;

use TestUntil\Form\AbstractForm;
use Zend\Form\Element;

class AbstractSearchForm extends AbstractForm
{
    public function __construct($formName)
    {
        parent::__construct($formName);

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
