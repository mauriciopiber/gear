<?php
namespace Column\Form\Search;

use Column\Form\Search\AbstractSearchForm;
use Zend\Form\Element;

class ColumnsSearchForm extends AbstractSearchForm
{
    public function __construct($entityManager)
    {
        parent::__construct('columnsSearchForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'columnsSearch');
        $this->setAttribute('class', 'form-inline');
        $this->setEntityManager($entityManager);

        $columnDate = new Element\Date('columnDatePre');
        $columnDate->setAttributes(array(
            'name' => 'columnDatePre',
            'id' => 'columnDatePre',
            'type' => 'date',
            'step' => 'any',
            'class' => 'form-control date'
        ));
        $columnDate->setLabel('Column Date de');
        $this->add($columnDate);

        $columnDate = new Element\Date('columnDatePos');
        $columnDate->setAttributes(array(
            'name' => 'columnDatePos',
            'id' => 'columnDatePos',
            'type' => 'date',
            'step' => 'any',
            'class' => 'form-control date'
        ));
        $columnDate->setLabel('até');
        $this->add($columnDate);
            $columnDecimalPre = new Element('columnDecimalPre');
            $columnDecimalPre->setAttributes(array(
                'name' => 'columnDecimalPre',
                'id' => 'columnDecimalPre',
                'type' => 'text',
                'class' => 'form-control decimal'
            ));
            $columnDecimalPre->setLabel('Column Decimal de');
            $this->add($columnDecimalPre);

            $columnDecimalPos = new Element('columnDecimalPos');
            $columnDecimalPos->setAttributes(array(
                'name' => 'columnDecimalPos',
                'id' => 'columnDecimalPos',
                'type' => 'text',
                'class' => 'form-control decimal'
            ));
            $columnDecimalPos->setLabel('até');
            $this->add($columnDecimalPos);
            $columnDatetimePre = new Element\DateTime('columnDatetimePtBrPre');
            $columnDatetimePre->setAttributes(array(
                'name' => 'columnDatetimePtBrPre',
                'id' => 'columnDatetimePtBrPre',
                'type' => 'datetime',
                'step' => 'any',
                'class' => 'form-control datetime-pt-br'
            ));
            $columnDatetimePre->setFormat('d/m/Y H:i:s');
            $columnDatetimePre->setLabel('Column Datetime Pt Br de');
            $this->add($columnDatetimePre);

            $columnDatetimePos = new Element\DateTime('columnDatetimePtBrPos');
            $columnDatetimePos->setAttributes(array(
                'name' => 'columnDatetimePtBrPos',
                'id' => 'columnDatetimePtBrPos',
                'type' => 'datetime',
                'step' => 'any',
                'class' => 'form-control datetime-pt-br'
            ));
            $columnDatetimePos->setFormat('d/m/Y H:i:s');
            $columnDatetimePos->setLabel('até');
            $this->add($columnDatetimePos);
        $columnDatePtBr = new Element\Date('columnDatePtBrPre');
        $columnDatePtBr->setAttributes(array(
            'name' => 'columnDatePtBrPre',
            'id' => 'columnDatePtBrPre',
            'type' => 'date',
            'step' => 'any',
            'class' => 'form-control date'
        ));
        $columnDatePtBr->setLabel('Column Date Pt Br de');
        $this->add($columnDatePtBr);

        $columnDatePtBr = new Element\Date('columnDatePtBrPos');
        $columnDatePtBr->setAttributes(array(
            'name' => 'columnDatePtBrPos',
            'id' => 'columnDatePtBrPos',
            'type' => 'date',
            'step' => 'any',
            'class' => 'form-control date'
        ));
        $columnDatePtBr->setLabel('até');
        $this->add($columnDatePtBr);
            $columnDecimalPre = new Element('columnDecimalPtBrPre');
            $columnDecimalPre->setAttributes(array(
                'name' => 'columnDecimalPtBrPre',
                'id' => 'columnDecimalPtBrPre',
                'type' => 'text',
                'class' => 'form-control money'
            ));
            $columnDecimalPre->setLabel('Column Decimal Pt Br de');
            $this->add($columnDecimalPre);

            $columnDecimalPos = new Element('columnDecimalPtBrPos');
            $columnDecimalPos->setAttributes(array(
                'name' => 'columnDecimalPtBrPos',
                'id' => 'columnDecimalPtBrPos',
                'type' => 'text',
                'class' => 'form-control money'
            ));
            $columnDecimalPos->setLabel('até');
            $this->add($columnDecimalPos);

	    $columnForeignKey = array(
            'name' => 'columnForeignKey',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Column Foreign Key',
                'object_manager' => $this->getEntityManager(),
                'target_class' => 'Column\Entity\ForeignKeys',
                'property' => 'name',
                'empty_option' => 'Escolher:',
            ),
        );
        $this->add($columnForeignKey);
    }
}
