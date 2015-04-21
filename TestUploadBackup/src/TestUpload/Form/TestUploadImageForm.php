<?php
namespace TestUpload\Form;

use TestUpload\Form\AbstractForm;
use Zend\Form\Element;

class TestUploadImageForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('testUploadImageForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);

        $idTestUpload = new Element('idTestUploadImage');
        $idTestUpload->setLabel('Test Upload Image');
        $idTestUpload->setAttributes(array(
            'name' => 'idTestUploadImage',
            'id' => 'idTestUploadImage',
            'type' => 'hidden',
        ));
        $this->add($idTestUpload);

        $image = new Element\File('image');
        $image->setLabel('Image');
        $image->setAttributes(array(
            'name' => 'image',
            'id' => 'image',
            'type' => 'file',
            'class' => 'form-control'
        ));
        $this->add($image);

        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
