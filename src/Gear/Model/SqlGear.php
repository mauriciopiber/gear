<?php

namespace Gear\Model;

/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class SqlGear extends MakeGear implements  \Zend\ServiceManager\ServiceLocatorAwareInterface
{

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->sm;
    }

    public function addColumn($table = null,$column = null)
    {
        die('1');
        /*
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $query = $em->createQuery('ALTER TABLE src_backlog_status ADD test VARCHAR(10) NULL');
        $query->getResult();
        //var_dump($em);
*/
    }

}
