<?php
namespace Gear\Project\Config;

use Zend\InputFilter\InputFilter;

class LocalFilter extends InputFilter
{
    public function getInputFilter()
    {
        $dbms = new Input('username');
        $dbms->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $dbname = new Input('password');
        $dbname->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $dblocal = new Input('host');
        $dblocal->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $environment = new Input('environment');
        $environment->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());


        $this->add($dbms);
        $this->add($dbname);
        $this->add($dblocal);
        $this->add($environment);

        return $this;
    }
}
