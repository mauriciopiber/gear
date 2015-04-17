<?php
namespace AdminCoola\Form;

use AdminCoola\Form\AbstractForm;
use Zend\Form\Element;

class CardForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('cardForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);

        $idCard = new Element('idCard');
        $idCard->setLabel('Card');
        $idCard->setAttributes(array(
            'name' => 'idCard',
            'id' => 'idCard',
            'type' => 'hidden',
        ));
        $this->add($idCard);

	    $idLearn = array(
            'name' => 'idLearn',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'id' => 'idLearn'
            ),
            'options' => array(
                'label' =>' Learn',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'AdminCoola\Entity\Learn',
                'property' => 'name',
                'empty_option' => 'Escolher:',
                'class' => 'form-control'
            ),
        );
        $this->add($idLearn);

        $title = new Element('title');
        $title->setLabel('Title');
        $title->setAttributes(array(
            'name' => 'title',
            'id' => 'title',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $this->add($title);

        $imageDescription = new Element\File('imageDescription');
        $imageDescription->setLabel('Image Description');
        $imageDescription->setAttributes(array(
            'name' => 'imageDescription',
            'id' => 'imageDescription',
            'type' => 'file',
            'class' => 'form-control'
        ));
        $this->add($imageDescription);

        $textDescription = new Element\Textarea('textDescription');
        $textDescription->setLabel('Text Description');
        $textDescription->setAttributes(array(
            'name' => 'textDescription',
            'id' => 'textDescription',
            'type' => 'textarea',
            'class' => 'form-control'
        ));
        $this->add($textDescription);

        $idLearn = array(
            'name' => 'idCardTheme',
            'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
            'attributes' => array(
                'id' => 'idCardTheme',
                'multiple' => true
            ),
            'options' => array(
                'label' =>' Card Theme',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'AdminCoola\Entity\Theme',
                'property' => 'name',
                'empty_option' => 'Escolher:',
                'class' => 'form-control'
            ),
        );
        $this->add($idLearn);

        $idLearn = array(
            'name' => 'idCardLevel',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'id' => 'idCardLevel',
                'multiple' => true
            ),
            'options' => array(
                'label' =>' Card Level',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'AdminCoola\Entity\Level',
                'property' => 'name',
                'empty_option' => 'Escolher:',
                'class' => 'form-control'
            ),
        );
        $this->add($idLearn);

        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
