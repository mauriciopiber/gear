<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;

class PasswordConfirm extends Varchar
{


    public function getFixtureData($iterator)
    {
        $basePass = '123456'."".$iterator;


        $bcrypt = new \Zend\Crypt\Password\Bcrypt();
        $bcrypt->setCost(14);

        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $bcrypt->create($basePass)
        ).PHP_EOL;
    }
}