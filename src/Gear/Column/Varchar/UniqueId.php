<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\Mvc\ServiceAwareInterface;

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
class UniqueId extends Varchar implements ServiceAwareInterface
{
    protected $uniqueId;


    /**
     * Formata a saida para ser utizada em Gear\Mvc\Fixture\FixtureService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getFixture()
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

    /*
    public function getFilterFormElement()
    {
        $element = '';
        return $element;
    }
    */

    /**
     * Código para ser utilizado após deletar ítem em Service
     *
     * @return string
     */
    public function getServiceDeleteBody()
    {
        return '';
    }


    /**
     * Cria o código para ser inserido no service em Gear\Mvc\Service\ServiceService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceInsertBody()
     *
     * @return string
     */
    public function getServiceInsertBody()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        \$data['$elementName'***REMOVED*** = uniqid(true, true);

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
    public function getServiceUpdateBody()
    {
        return $this->getServiceInsertBody();
    }

    /**
     * Código que é executado quando a entidade é atualizada com sucesso
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceUpdateSuccess()
     *
     * @return string
     */
    public function getServiceUpdateSuccess()
    {
        return '';
    }

    /**
     * Código que é executado quando a entidade é atualizada com sucesso
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceUpdateSuccess()
     *
     * @return string
     */
    public function getServiceInsertSuccess()
    {
        return '';
    }
}
