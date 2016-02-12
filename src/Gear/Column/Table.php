<?php
/**
 * PIBERNETWORK - Tecnologia inteligente.
 *
 * ALL RIGHTS RESERVED.
 *
 * PHP VERSION 5.6
 *
 *  @category   Columns
 *  @package    Gear
 *  @subpackage Gear
 *  @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 *  @copyright  2014-2016 Mauricio Piber Fão
 *  @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 *  @link       https://bitbucket.org/mauriciopiber/gear
 */
namespace Gear\Column;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Classe que verifica a tabela e cria as colunas específicas.
 *
 * Cria a estrutura que será utilizada pelo Mvc para definir o que é criado em cada tela.
 *
 * @category   Schema
 * @package    Gear
 * @subpackage Gear
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */

class Table implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
}
