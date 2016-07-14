<?php
namespace Gear\Column;

/**
 *
 * Interface para colunas que precisam implementar serviços.
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
interface ImplementsInterface
{
    /**
     * Pega as implementações que serão inseridas na classe.
     *
     * @param string $codeName Tipo SRC
     *
     * @return string
     */
    public function getImplements($codeName);
}
