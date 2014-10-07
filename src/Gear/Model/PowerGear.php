<?php

namespace Gear\Model;
/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class PowerGear extends MakeGear implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    private $sm;

    public function __construct()
    {
        //parent::setConfig($configuration);
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->sm;
    }

    public function make($element = null)
    {
        if ($element != null) {
            $class = 'Gear\Model\\'.$element.'Gear';

            if (class_exists($class)) {
                $n = new $class($this->getConfig());

                if (method_exists($n,'generate')) {
                    $n->generate();
                } else {
                    throw new \Exception('Não existe o método generate na classe '.$class);
                }

                echo 'Gerados à partir da classe '.$class."\n";

            } else {

                throw new \Exception('Não existe a classe '.$class);
            }
        } else {
            throw new \Exception('Elemento não foi informado corretamente');
        }
    }

    public function toClass($name)
    {
        return $this->str('class',$name);
    }

    public function empower($exclude = null)
    {
        if ($exclude) {
            $excludeGear = explode(',',$exclude);

            foreach ($excludeGear as $i => $v) {
                $excludeGear[$i***REMOVED*** = $this->str('class',$v);
            }
        } else {
            $excludeGear = array();
        }

        $gearPrincipal = array(
            'EntityUnit',
            'Model',
            //'ModelUnit',
            'Logic',
            //'LogicUnit',
            'Form',
            'Filter',
            'Search',
            'Controller',
            'ControllerUnit',
            'View',
            //'Fixture'
        );

        foreach ($gearPrincipal as $i => $nameGear) {
            $class = 'Gear\Model\\'.$nameGear.'Gear';

            if (class_exists($class) && !in_array($nameGear,$excludeGear)) {
                $n = new $class($this->getConfig());
                $n->generate();
                echo 'Gerados à partir da classe '.$class."\n";
            }
        }
    }

}
