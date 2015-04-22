<?php
namespace Column\Filter;

use Column\Filter\AbstractFilter;

class ColumnsFilter extends AbstractFilter
{
    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'columnDate',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnDatetime',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnTime',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnInt',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnTinyint',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnDecimal',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnVarchar',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnLongtext',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnText',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnDatetimePtBr',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnDatePtBr',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnDecimalPtBr',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnIntCheckbox',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnTinyintCheckbox',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'columnVarcharEmail',
                'required' => false,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    $this->getEmailAddressValidator('Column Varchar Email')
                )
            )
        );
        $this->add(array(
            'name'       => 'columnVarcharPasswordVerify',
            'required'   => 'true',
            'filters'    => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => 6,
                    ),
                ),
            ),
        ));
        $this->add(array(
            'name'       => 'columnVarcharPasswordVerifyVerify',
            'required'   => 'true',
            'filters'    => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => 6,
                    ),
                ),
                array(
                    'name'    => 'Identical',
                    'options' => array(
                        'token' => 'columnVarcharPasswordVerify',
                    ),
                ),
            ),
        ));
        // File Input
        $fileInput = new \Zend\InputFilter\FileInput('columnVarcharUploadImage');
        $fileInput->setRequired(false);
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    => \Security\Module::getProjectFolder().'/public/tmpImage/columnVarcharUploadImagetempimg.png',
                'randomize' => true,
            )
        );
        $this->add($fileInput);
        $this->add(
            array(
                'name' => 'columnForeignKey',
                'required' => false,
            )
        );
        return $this;
    }
}
