<?php
namespace TestUpload\Form\Search;

use TestUpload\Form\Search\AbstractSearchForm;
use Zend\Form\Element;

class TestUploadImageSearchForm extends AbstractSearchForm
{
    public function __construct($entityManager)
    {
        parent::__construct('testUploadImageSearchForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'testUploadImageSearch');
        $this->setAttribute('class', 'form-inline');
        $this->setEntityManager($entityManager);

    }
}
