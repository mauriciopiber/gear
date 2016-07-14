<?php
namespace Gear\Column\Mvc;

/**
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
interface ServiceAwareInterface
{
    /**
     * Gera o código usado para processar o $_POST antes de criar em repository em Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getServiceInsertBody();

    /**
     * Gera o código usado para processar o $_POST depois de criar em repository em Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getServiceInsertSuccess();

    /**
     * Gera o código usado para processar o $_POST antes de editar em repository em Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getServiceUpdateBody();

    /**
     * Gera o código usado para processar o $_POST depois de editar em repository em Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getServiceUpdateSuccess();

    //public function updateToInject();

    //public function functionsToInject();

    //public function useToInject();

    //public function attributeToInject();
}
