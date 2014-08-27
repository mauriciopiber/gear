<?php
namespace Gear\Model;
use Zend\Db\Adapter\Adapter;


/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class ManagerGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getSpeciality($table,$column) {

    	$crudArray = $this->getConfig()->getEntityManager()->getRepository('Manager\Entity\ManCrud')->findBy(array('name' => $this->str('class',$table)));


    	//var_dump($crudArray);var_dump($table);
    	$crud = array_pop($crudArray);
    	$fieldArray = $this->getConfig()->getEntityManager()->getRepository('\Manager\Entity\ManField')->findBy(array('idCrud' => $crud->getIdCrud(),'name' => $column));


    	$field = array_pop($fieldArray);

    	$specialized = $field->getIdSpecialityField();

    	if(isset($specialized)) {
    		$out = $specialized->getName();
    	} else {
    		$out = 'default';
    	}
    	return $out;
    }

    /**
     * Especialidades:
     *
     * Dinheiro - Deve criar automaticamente uma mascara no input pra aceitar só valores no padrão financeiro.
     * Deve salvar corretamente no banco de dados.
     * Deve exibir corretamente os dados salvos no banco de dados
     *
     */
}