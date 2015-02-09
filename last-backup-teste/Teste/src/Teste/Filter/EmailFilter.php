<?php
namespace Teste\Filter;

use Teste\Filter\AbstractFilter;

class EmailFilter extends AbstractFilter
{
    public function __construct()
    {

    }

    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'remetente',
                'required' => false,
                'validators' => array(
                    $this->getNotEmptyValidator('Remetente'),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 150                        ),
                    ),
                ),
            )
        );
        $this->add(
            array(
                'name' => 'destino',
                'required' => true,
                'validators' => array(
                    $this->getNotEmptyValidator('Destino'),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 150                        ),
                    ),
                ),
            )
        );
        $this->add(
            array(
                'name' => 'assunto',
                'required' => true,
                'validators' => array(
                    $this->getNotEmptyValidator('Assunto'),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100                        ),
                    ),
                ),
            )
        );
        $this->add(
            array(
                'name' => 'mensagem',
                'required' => true,
                'validators' => array(
                    $this->getNotEmptyValidator('Mensagem'),
                ),
            )
        );

        return $this;
    }
}
