<?php
namespace Column\Form;

use Column\Form\AbstractForm;
use Zend\Form\Element;

class ColumnsForm extends AbstractForm
{
    public function __construct($entityManager)
    {
        parent::__construct('columnsForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'fileupload');

        $this->setEntityManager($entityManager);

        $idColumns = new Element('idColumns');
        $idColumns->setLabel('Columns');
        $idColumns->setAttributes(array(
            'name' => 'idColumns',
            'id' => 'idColumns',
            'type' => 'hidden',
        ));
        $this->add($idColumns);

        $columnDate = new Element\Date('columnDate');
        $columnDate->setAttributes(array(
            'name' => 'columnDate',
            'id' => 'columnDate',
            'type' => 'date',
            'class' => 'form-control date'
        ));
        $columnDate->setLabel('Column Date');
        $this->add($columnDate);

        $columnDatetime = new Element\DateTime('columnDatetime');
        $columnDatetime->setAttributes(array(
            'name' => 'columnDatetime',
            'id' => 'columnDatetime',
            'type' => 'datetime',
            'step' => 'any',
            'class' => 'form-control datetime'
        ));
        $columnDatetime->setFormat('Y-m-d H:i:s');
        $columnDatetime->setLabel('Column Datetime');
        $this->add($columnDatetime);

        $columnTime = new Element\Time('columnTime');
        $columnTime->setAttributes(array(
            'name' => 'columnTime',
            'id' => 'columnTime',
            'step' => 'any',
            'class' => 'form-control time'
        ));
        $columnTime->setLabel('Column Time');
        $this->add($columnTime);

        $columnInt = new Element('columnInt');
        $columnInt->setLabel('Column Int');
        $columnInt->setAttributes(array(
            'name' => 'columnInt',
            'id' => 'columnInt',
            'type' => 'text',
            'class' => 'form-control integer'
        ));
        $this->add($columnInt);

        $columnTinyint = new Element('columnTinyint');
        $columnTinyint->setLabel('Column Tinyint');
        $columnTinyint->setAttributes(array(
            'name' => 'columnTinyint',
            'id' => 'columnTinyint',
            'type' => 'text',
            'class' => 'form-control integer'
        ));
        $this->add($columnTinyint);

        $columnDecimal = new Element('columnDecimal');
        $columnDecimal->setLabel('Column Decimal');
        $columnDecimal->setAttributes(array(
            'name' => 'columnDecimal',
            'id' => 'columnDecimal',
            'type' => 'text',
            'class' => 'form-control decimal'
        ));
        $this->add($columnDecimal);

        $columnVarchar = new Element('columnVarchar');
        $columnVarchar->setLabel('Column Varchar');
        $columnVarchar->setAttributes(array(
            'name' => 'columnVarchar',
            'id' => 'columnVarchar',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $this->add($columnVarchar);

        $columnLongtext = new Element('columnLongtext');
        $columnLongtext->setAttributes(array(
            'name' => 'columnLongtext',
            'id' => 'columnLongtext',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $columnLongtext->setLabel('Column Longtext');
        $this->add($columnLongtext);

        $columnText = new Element\Textarea('columnText');
        $columnText->setLabel('Column Text');
        $columnText->setAttributes(array(
            'name' => 'columnText',
            'id' => 'columnText',
            'type' => 'textarea',
            'class' => 'form-control'
        ));
        $this->add($columnText);

        $columnDatetime = new Element\DateTime('columnDatetimePtBr');
        $columnDatetime->setAttributes(array(
            'name' => 'columnDatetimePtBr',
            'id' => 'columnDatetimePtBr',
            'type' => 'datetime',
            'step' => 'any',
            'class' => 'form-control datetime-pt-br'
        ));
        $columnDatetime->setFormat('d/m/Y H:i:s');
        $columnDatetime->setLabel('Column Datetime Pt Br');
        $this->add($columnDatetime);

        $columnDatePtBr = new Element\Date('columnDatePtBr');
        $columnDatePtBr->setAttributes(array(
            'name' => 'columnDatePtBr',
            'id' => 'columnDatePtBr',
            'type' => 'date',
            'class' => 'form-control date-pt-br'
        ));
        $columnDatePtBr->setFormat('d/m/Y');
        $columnDatePtBr->setLabel('Column Date Pt Br');
        $this->add($columnDatePtBr);

        $columnDecimal = new Element('columnDecimalPtBr');
        $columnDecimal->setLabel('Column Decimal Pt Br');
        $columnDecimal->setAttributes(array(
            'name' => 'columnDecimalPtBr',
            'id' => 'columnDecimalPtBr',
            'type' => 'text',
            'class' => 'form-control money'
        ));
        $this->add($columnDecimal);

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'columnIntCheckbox',
            'options' => array(
                'label' => 'Column Int Checkbox',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'default_value' => '0'
            ),
            'attributes' => array(
                 'value' => '0',
                 'id' => 'columnIntCheckbox'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'columnTinyintCheckbox',
            'options' => array(
                'label' => 'Column Tinyint Checkbox',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'default_value' => '0'
            ),
            'attributes' => array(
                 'value' => '0',
                 'id' => 'columnTinyintCheckbox'
            )
        ));
        $columnVarchar = new Element('columnVarcharEmail');
        $columnVarchar->setLabel('Column Varchar Email');
        $columnVarchar->setAttributes(array(
            'name' => 'columnVarcharEmail',
            'id' => 'columnVarcharEmail',
            'type' => 'text',
            'class' => 'form-control'
        ));
        $this->add($columnVarchar);

        $columnVarchar = new Element('columnVarcharPasswordVerify');
        $columnVarchar->setAttributes(array(
            'name' => 'columnVarcharPasswordVerify',
            'id' => 'columnVarcharPasswordVerify',
            'type' => 'password',
            'class' => 'form-control'
        ));
        $columnVarchar->setLabel('Column Varchar Password Verify');
        $this->add($columnVarchar);

        $columnVarcharVerify = new Element('columnVarcharPasswordVerifyVerify');
        $columnVarcharVerify->setAttributes(array(
            'name' => 'columnVarcharPasswordVerifyVerify',
            'id' => 'columnVarcharPasswordVerifyVerify',
            'type' => 'password',
            'class' => 'form-control'
        ));
        $columnVarcharVerify->setLabel('Column Varchar Password Verify Verify');
        $this->add($columnVarcharVerify);
        $columnVarchar = new Element\File('columnVarcharUploadImage');
        $columnVarchar->setLabel('Column Varchar Upload Image');
        $columnVarchar->setAttributes(array(
            'name' => 'columnVarcharUploadImage',
            'id' => 'columnVarcharUploadImage',
            'type' => 'file',
            'class' => 'form-control'
        ));
        $this->add($columnVarchar);

	    $columnForeignKey = array(
            'name' => 'columnForeignKey',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'id' => 'columnForeignKey'
            ),
            'options' => array(
                'label' =>' Column Foreign Key',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'Column\Entity\ForeignKeys',
                'property' => 'name',
                'empty_option' => 'Escolher:',
                'class' => 'form-control'
            ),
        );
        $this->add($columnForeignKey);

        $submit = new Element('submit');
        $submit->setValue('Salvar');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));
        $this->add($submit);
    }
}
