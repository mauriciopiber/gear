<?php
namespace Gear\Column\Mvc;

/**
 *
 * Interface para colunas que precisam incluir código no Search e View, com Filtro customizado.
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
interface SearchFormInterface
{
    /**
     * Gera o código para ser utilizado em Gear\Mvc\Search\SearchService
     *
     * @return string
     */
    public function getSearchFormElement();

    /**
     * Gera o código para ser utilizado em Gear\Mvc\View\ViewService
     *
     * @return string
     */
    public function getSearchViewElement();
}
