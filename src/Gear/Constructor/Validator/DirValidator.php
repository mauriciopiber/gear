<?php
namespace Gear\Constructor\Validator;

use Zend\Validator\AbstractValidator;

class DirValidator extends AbstractValidator
{

    const DIRNOTFOUND = 'DIRNOTFOUNT';

    protected $messageTemplates = array(
        self::DIRNOTFOUND => 'Dir does\'t not exist.'
    );

    public function __construct(array $options = array())
    {
        parent::__construct($options);
    }

    public function isValid($value)
    {
        $this->setValue($value);
        //$this->error(self::NOTSPECIAL);
        return true;
    }
}