<?php
namespace PiberNetwork\Filter;

use PiberNetwork\Filter\AbstractFilter;

class PrecoTipoServicoFilter extends AbstractFilter
{
    public function __construct()
    {

    }

    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'idTipoServico',
                'required' => false,
                                'validators' => array(
                    $this->getNotEmptyValidator(' Tipo Servico')
                ),
                            )
        );
        $this->add(
            array(
                'name' => 'precoHora',
                'required' => true,
                                'validators' => array(
                    $this->getNotEmptyValidator('Preco Hora')
                ),
                            )
        );
        $this->add(
            array(
                'name' => 'dataInicio',
                'required' => true,
                                'validators' => array(
                    $this->getNotEmptyValidator('Data Inicio')
                ),
                            )
        );
        $this->add(
            array(
                'name' => 'dataFinal',
                'required' => true,
                                'validators' => array(
                    $this->getNotEmptyValidator('Data Final')
                ),
                            )
        );

        return $this;
    }
}
