<?php
namespace Teste\Form\Search;

use Teste\Form\Search\AbstractSearchForm;
use Zend\Form\Element;

class EmailSearchForm extends AbstractSearchForm
{
    public function __construct($entityManager)
    {
        parent::__construct('emailSearchForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'emailSearch');
        $this->setAttribute('class', 'form-inline');
        $this->setEntityManager($entityManager);

    }
}
