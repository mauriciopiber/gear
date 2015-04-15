<?php
namespace Teste\Filter;

use Teste\Filter\AbstractFilter;

class EmailFilter extends AbstractFilter
{
    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'remetente',
                'required' => true,
            )
        );
        $this->add(
            array(
                'name' => 'destino',
                'required' => true,
            )
        );
        $this->add(
            array(
                'name' => 'assunto',
                'required' => true,
            )
        );
        $this->add(
            array(
                'name' => 'mensagem',
                'required' => true,
            )
        );
        return $this;
    }
}
