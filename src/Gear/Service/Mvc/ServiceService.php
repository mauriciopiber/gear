<?php
/**
 *
 * @author piber
 * Um serviço é o ítem mais importante do DDD.
 * Um serviço precisa ser testado com TDD.
 * Um serviço não possui interface então não precisa ser testado com codeception.
 * Um serviço pode extender outro serviço.
 * Um serviço precisa ser adicionado ao invokables do Module.php ao final do processo.
 *
 */
namespace Gear\Service\Mvc;

use Gear\Service\AbstractService;

class ServiceService extends AbstractService {

    public function create($options)
    {
        if (!isset($options->name)) {
            return 'Missing name on JSON configuration';
        }

        $location = $this->getConfig()->getSrc().'/Service';

        if (!is_file($location.'/AbstractService.php')) {
            $this->getAbstract();
        }

        $class = $options->name;
        $extends = (isset($options->extends) ? $options->extends : 'AbstractService');

        $this->createFileFromTemplate(
            'src/emptyService',
            array(
        	    'class'   => $class,
                'extends' => $extends,
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'.php',
            $location
        );

        $this->createFileFromTemplate(
            'test/emptyService',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'Test.php',
            $this->getConfig()->getModuleTestUnit().'/ServiceTest'
        );

        //verifica se já existe a classe abstrata do sistema.
        //caso não exista, criar
        //verificar se existe meta informações sobre essa classe alvo
        //se existe, utilizar
        //se não, usar template padrão.
        echo 'Create from ServiceService called'."\n";
        return $options;
    }

    public function delete()
    {
        echo 'Delete from ServiceService called'."\n";
    }

    public function getAbstract()
    {
        //echo $this->getConfig()->getSrc() . '/Service'  ;die();
        $this->createFileFromTemplate(
            'src/abstractService',
            array(
                'module' => $this->getConfig()->getModule()
            ),
            'AbstractService.php',
            $this->getConfig()->getSrc() . '/Service/'
        );
        echo 'getAbstract from ServiceService called'."\n";
    }
}
