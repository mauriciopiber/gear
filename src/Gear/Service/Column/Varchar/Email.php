<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;

class Email extends Varchar
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'varchar') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }


    public function getFixtureData($iterator)
    {
        $faker = \Faker\Factory::create();

        return sprintf(
            '                \'%s\' => \'%d%s\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $faker->email
        ).PHP_EOL;

    }
}
