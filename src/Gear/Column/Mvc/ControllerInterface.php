<?php
namespace Gear\Column\Mvc;

/**
 *
 * Interface para colunas que precisam incluir código no Controller
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
interface ControllerInterface
{
    /**
     * Gera o código pra ser usado antes da validação dos campos em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerPreValidate();

    /**
     * Gera o código pra ser usado antes da exibir na view os campos em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerPreShow();
}
