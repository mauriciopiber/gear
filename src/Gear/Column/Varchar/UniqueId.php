<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;


/**
 *
 * Classe que cria colunas para criar valores aleatórios
 *
 * @category   Column
 * @package    Gear
 * @subpackage Column
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class UniqueId extends Varchar
{

    protected $uniqueId;


    /**
     * Formata a saida para ser utizada em Gear\Mvc\Fixture\FixtureService
     *
     * @param int $iterator Número base.
     *
     * @return string
     */
    public function getFixtureData($iterator)
    {
        $this->uniqueId = uniqid(true, true);

        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $this->uniqueId
        ).PHP_EOL;
    }


    /**
     * Cria código responsável por adicionar o Hydrator nos Testes unitários do repositório, método editar.
     * Poderá ser passada pra AbstractColumn após a evolução.
     */
    public function getRepositoryTestUpdateHydrator()
    {
        $ndnt = str_repeat(' ', 2*4);

        $columnName = $this->str('class', $this->column->getName());

        $template = '$entity->set%s(123)->shouldBeCalled();';

        return $ndnt.sprintf($template, $columnName).PHP_EOL;
    }


    /**
     * Cria código responsável por adicionar o Persist nos Testes unitários do repositório, método criar.
     * Poderá ser passada pra AbstractColumn após a evolução.
     */
    public function getRepositoryTestUpdatePersist()
    {
        $ndnt = str_repeat(' ', 2*4);

        $columnName = $this->str('class', $this->column->getName());

        $template = '$entityPersist->set%s(123);';

        return $ndnt.sprintf($template, $columnName).PHP_EOL;
    }

    /**
     * Cria código responsável por adicionar a Data nos Testes unitários do repositório, método criar.
     * Poderá ser passada pra AbstractColumn após a evolução.
     */
    public function getRepositoryTestUpdateData()
    {
        return $this->getRepositoryTestInsertData();
    }

    /**
     * Cria código responsável por adicionar o Persist nos Testes unitários do repositório, método criar.
     * Poderá ser passada pra AbstractColumn após a evolução.
     */
    public function getRepositoryTestInsertPersist()
    {
        return $this->getRepositoryTestUpdatePersist();
    }

    /**
     * Cria código responsável por adicionar a Data nos Testes unitários do repositório, método criar.
     * Poderá ser passada pra AbstractColumn após a evolução.
     */
    public function getRepositoryTestInsertData()
    {
        $ndnt = str_repeat(' ', 3*4);

        $columnName = $this->str('var', $this->column->getName());

        $template = '\'%s\' => 123,';

        return $ndnt.sprintf($template, $columnName).PHP_EOL;
    }

    /**
     * Cria o código para ser inserido no service em Gear\Mvc\Service\ServiceService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceInsertBody()
     *
     * @return string
     */
    public function getRepositoryInsertBefore()
    {
        $elementName = $this->str('class', $this->column->getName());

        $var = $this->str('var', $elementName);
        $varlength = $this->str('var-length', $elementName);

        $element = <<<EOS
        \${$varlength} = isset(\$data['{$var}'***REMOVED***)
          && !empty(\$data['{$var}'***REMOVED***)
          ?  \$data['{$var}'***REMOVED***
          : uniqid(true, true);

        \$entity->set{$elementName}(\${$varlength});

EOS;

        return $element;
    }

    /**
     * Código que é executado antes do service enviar o pedido de atualizar para o repository
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceUpdateBody()
     *
     * @return string
     */
    public function getRepositoryUpdateBefore()
    {
        return $this->getRepositoryInsertBefore();
    }
}
