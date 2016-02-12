<?php
namespace Gear\Project;

use Zend\InputFilter\InputFilter;

class ProjectFilter extends InputFilter
{
    public function valid($data)
    {
        $projectFilter = $this->getInputFilter();


        $isValid = $projectFilter->setData($data)
        ->setValidationGroup(\Zend\InputFilter\InputFilterInterface::VALIDATE_ALL)
        ->isValid();

        return $isValid;
    }

    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'project',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                )
            )
        );

        $this->add(
            array(
                'name' => 'git',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                )
            )
        );

        $this->add(
            array(
                'name' => 'host',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                )
            )
        );

        return $this;
    }
}
