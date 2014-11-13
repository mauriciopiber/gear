<?php
namespace Gear\Filter;

use Zend\InputFilter\InputFilter;

class GloballyFilter extends InputFilter
{
    public function getInputFilter()
    {
        $dbms = new Input('dbms');
        $dbms->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $dbname = new Input('dbname');
        $dbname->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $dblocal = new Input('dbhost');
        $dblocal->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());


        $this->add($dbms);
        $this->add($dbname);
        $this->add($dblocal);

        return $this;
    }

}
