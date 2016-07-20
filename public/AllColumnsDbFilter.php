<?php
namespace MyModule\Filter;

use GearBase\Filter\AbstractFilter;

class AllColumnsDbFilter extends AbstractFilter
{
    /**
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function getInputFilter()
    {
        $this->add(array(
            'name'       => 'varcharPasswordVerify',
            'required'   => true,
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
            'name'       => 'varcharPasswordVerifyVerify',
            'required'   => true,
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
                        'token' => 'varcharPasswordVerify',
                    ),
                ),
            ),
        ));
        // File Input
        $fileInput = new \Zend\InputFilter\FileInput('varcharUploadImage');
        $fileInput->setRequired(false);
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    =>
                \GearBase\Module::getProjectFolder().'/public/_temp/varcharUploadImagetempimg.png',
                'randomize' => true,
            )
        );
        $this->add($fileInput);
        $message = 'O valor é inválido';
        $this->add(
            array(
                'name' => 'varcharUrl',
                'required' => false,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    [
                        'name' => 'Hostname',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\Hostname::CANNOT_DECODE_PUNYCODE  => $message,
                                \Zend\Validator\Hostname::INVALID                 => $message,
                                \Zend\Validator\Hostname::INVALID_DASH            => $message,
                                \Zend\Validator\Hostname::INVALID_HOSTNAME        => $message,
                                \Zend\Validator\Hostname::INVALID_HOSTNAME_SCHEMA => $message,
                                \Zend\Validator\Hostname::INVALID_LOCAL_NAME      => $message,
                                \Zend\Validator\Hostname::INVALID_URI             => $message,
                                \Zend\Validator\Hostname::IP_ADDRESS_NOT_ALLOWED  => $message,
                                \Zend\Validator\Hostname::LOCAL_NAME_NOT_ALLOWED  => $message,
                                \Zend\Validator\Hostname::UNDECIPHERABLE_TLD      => $message,
                                \Zend\Validator\Hostname::UNKNOWN_TLD             => $message
                            ***REMOVED***
                        ***REMOVED***
                    ***REMOVED***
                )
            )
        );
        $this->add(
            array(
                'name' => 'varcharVarchar',
                'required' => false,
            )
        );
        $message = 'O valor é inválido';
        $this->add(
            array(
                'name' => 'varcharTelephone',
                'required' => false,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                     array(
                        'name' => 'Regex',
                        'options' =>  array(
                            'pattern'   => '/^(\([0-9***REMOVED***{2}\))\s([9***REMOVED***{1})?([0-9***REMOVED***{4})-([0-9***REMOVED***{4})$/',
                            'messages'  => [
                                \Zend\Validator\Regex::INVALID => $message,
                                \Zend\Validator\Regex::NOT_MATCH => $message,
                                \Zend\Validator\Regex::ERROROUS => $message
                            ***REMOVED***
                        )
                    )
                )
            )
        );

        $message = 'O valor é inválido';

        $this->add(
            array(
                'name' => 'varcharEmail',
                'required' => false,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(

                        array(
            'name' => 'EmailAddress',
            'options' => array(
                'messages' => array(
                    \Zend\Validator\EmailAddress::INVALID            => $message,
                    \Zend\Validator\EmailAddress::INVALID_FORMAT     => $message,
                    \Zend\Validator\EmailAddress::INVALID_HOSTNAME   => $message,
                    \Zend\Validator\EmailAddress::INVALID_MX_RECORD  => $message,
                    \Zend\Validator\EmailAddress::INVALID_SEGMENT    => $message,
                    \Zend\Validator\EmailAddress::DOT_ATOM           => $message,
                    \Zend\Validator\EmailAddress::QUOTED_STRING      => $message,
                    \Zend\Validator\EmailAddress::INVALID_LOCAL_PART => $message,
                    \Zend\Validator\EmailAddress::LENGTH_EXCEEDED    => $message,
                ),
            ),
            'break_chain_on_failure' => true
        )

                )
            )
        );
        $this->add(
            array(
                'name' => 'dateDate',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'dateDatePtBr',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'datetimeDatetime',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'datetimeDatetimePtBr',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'timeTime',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'decimalDecimal',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'decimalMoneyPtBr',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'intInt',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'intCheckbox',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'idIntForeignKey',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'tinyintTinyint',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'tinyintCheckbox',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'textText',
                'required' => false,
            )
        );
        $this->add(
            array(
                'name' => 'textHtml',
                'required' => false,
            )
        );
        return $this;
    }
}
