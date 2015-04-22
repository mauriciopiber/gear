<?php
namespace Column\Form\Search;

use Column\Form\Search\AbstractSearchForm;
use Zend\Form\Element;

class ForeignKeysSearchForm extends AbstractSearchForm
{
    public function __construct($entityManager)
    {
        parent::__construct('foreignKeysSearchForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'foreignKeysSearch');
        $this->setAttribute('class', 'form-inline');
        $this->setEntityManager($entityManager);

    }
}
