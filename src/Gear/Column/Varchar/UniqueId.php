<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
//use Gear\Column\Mvc\ServiceAwareInterface;
use Gear\Mvc\Repository\ColumnInterface\RepositoryInsertBeforeInterface;
use Gear\Mvc\Repository\ColumnInterface\RepositoryUpdateBeforeInterface;
//use Gear\Mvc\Service\ColumnInterface\ServiceDeleteInterface;

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
class UniqueId extends Varchar implements
    RepositoryInsertBeforeInterface,
    RepositoryUpdateBeforeInterface
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

        $element = <<<EOS
        \$entity->set{$elementName}(uniqid(true, true));

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
