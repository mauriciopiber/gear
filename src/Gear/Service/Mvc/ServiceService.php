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

use Gear\Service\Constructor\AbstractJsonService;

class ServiceService extends AbstractJsonService {

    public function getOptions()
    {

    }

    public function getServiceManagerFile()
    {
        return $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext/servicemanager.config.php';
    }

    public function updateServiceManager()
    {

        $serviceManagerFile = include $this->getServiceManagerFile();

        //var_dump(array($array));die();
        //die();

        $json = \Zend\Json\Json::decode(file_get_contents($this->getJson()));

        $module = &$json->{$this->getConfig()->getModule()};

        if (is_array($module->src)) {

            if (count($module->src)>0) {

                $this->createFileFromTemplate(
                    'config/update.servicemanager.config',
                    array(
                        'module' => $this->getConfig()->getModule(),
                        'factories' => $module->src
                    ),
                    'servicemanager.config.php',
                    $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
                );

            }
        }
    }

    public function create($options)
    {

        $json = $this->saveJson($options);

        $this->updateServiceManager();

        if ($options->getName() === null) {
            return 'Missing name on JSON configuration';
        }

        $location = $this->getConfig()->getSrc().'/Service';

        if (!is_file($location.'/AbstractService.php')) {
            $this->getAbstract();
        }

        $class = $options->getName();
        $extends = (null !== $options->getExtends()) ? $options->getExtends() : 'AbstractService';

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

    /**
     * A grande questão! Como o json é resolvido ao trabalhar com o PHP? ele fica com stdClass ou precisa ser convertido?
     *
     */
    public function saveJson($src)
    {
        $json = $this->getJson();

        $getOldFile = file_get_contents($json);

        $toArray = \Zend\Json\Json::decode($getOldFile);

        $module = &$toArray->{$this->getConfig()->getModule()};

        if (is_array($module->src)) {

            if (count($module->src)>0) {

                foreach ($module->src as $i => $srcItem) {
                    if ($srcItem->name == $src->getName()) {
                        return sprintf('%s as already set for %s'."\n", $src->getName(), $this->getConfig()->getModule());
                    }
                }
            }

            $std = new \stdClass();
            $std->name = $this->str('class', $src->getName());
            $std->type = $this->str('class', $src->getType());
            $module->src[***REMOVED*** = $std;
            //$module->src[$std***REMOVED***;
        }


        $moduleJson = $this->createModuleJson($module->src, $module->page, $module->db);


        $toArray = \Zend\Json\Json::encode($moduleJson);


        $file = $this->getFileService()->mkJson(
            $this->getConfig()->getModuleFolder().'/schema/',
            'module',
            $toArray
        );
/*
        $file = $this->getFileService()->mkJson(
            $this->getConfig()->getModuleFolder().'/schema/',
            'module',
            $toArray
        ); */
        return  sprintf('%s for %s created', $src->getName(), $this->getConfig()->getModule())."\n";
    }

    public function createEmptyJson()
    {

    }

    public function createModuleJson(array $src = array(), $page = array(), $db = array())
    {
        return array(
            $this->getConfig()->getModule() => array(
                'src' => $src,
                'page' => $page,
                'db' => $db
            )
        );
    }

}
