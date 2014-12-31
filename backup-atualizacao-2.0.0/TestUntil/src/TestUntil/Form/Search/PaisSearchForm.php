<?php
namespace TestUntil\Form\Search;

use TestUntil\Form\Search\AbstractSearchForm;
use Zend\Form\Element;

class PaisSearchForm extends AbstractSearchForm
{
    public function __construct($entityManager)
    {
        parent::__construct('paisSearchForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'paisSearch');
        $this->setAttribute('class', 'form-inline');
        $this->setEntityManager($entityManager);


    }
}
