<?php
namespace Gear\Column;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Column\ColumnService;
use Gear\Module\Structure\ModuleStructure;

/**
 *
 * Cria ColumnService com as suas dependências
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
class ColumnServiceFactory implements FactoryInterface
{
    /**
     * Cria o Serviço.
     *
     * @param ServiceLocatorInterface $container ServiceManager da aplicação
     *
     * @return \Gear\Column\ColumnService
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new ColumnService(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Table\TableService\TableService'),
            $container->get('Gear\Util\String\StringService')
        );
    }
}
