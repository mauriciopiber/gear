<?php
namespace Gear\Column\Mvc;

/**
 *
 * @deprecated Foi substituido por ColumnInterface
 *
 * Interface para colunas que precisam incluir código no Service
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
interface ServiceInterface
{
    /**
     * Gera o código pra ser utilizado no Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getService();
}
