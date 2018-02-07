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
namespace Gear\Mvc\Entity;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Db\Db;
use GearJson\Src\Src;
use Gear\Column\Integer\ForeignKey;
use Gear\Column\Integer\PrimaryKey;
use GearJson\Src\SrcTypesInterface;

class EntityTestService extends AbstractMvcTest
{
    public function createEntityTest($data)
    {
        return parent::forceDbTest($data, SrcTypesInterface::ENTITY);
    }

    public function createDbTest()
    {
        $this->tableName = $this->str('uline', $this->db->getTable());
        $this->columnManager = $this->db->getColumnManager();


        $options = [
            'module' => $this->getModule()->getModuleName()
        ***REMOVED***;

        $options['params'***REMOVED*** = $this->columnManager->extractCode('getEntityParam', [***REMOVED***, [
            \Gear\Column\Integer\PrimaryKey::class
        ***REMOVED***);

        $options['assertNull'***REMOVED*** = $this->columnManager->extractCode('getEntityAssertNull', [***REMOVED***);

        $options['asserts'***REMOVED*** =  $this->columnManager->extractCode('getEntitySetter', [***REMOVED***, [
            \Gear\Column\Integer\PrimaryKey::class
        ***REMOVED***);

        $options['mocks'***REMOVED*** = $this->columnManager->extractCode('getEntityMock', [***REMOVED***, [
            \Gear\Column\Integer\PrimaryKey::class
        ***REMOVED***);

        $options['exports'***REMOVED*** = $this->columnManager->extractCode('getEntityDataProvider', [***REMOVED***, [
            \Gear\Column\Integer\PrimaryKey::class
        ***REMOVED***);

        $options['className'***REMOVED*** = $this->str('class', $this->tableName);

        return $this->getFileCreator()->createFile(
            'template/module/mvc/entity-test/src.entity.phtml',
            $options,
            $this->str('class', $this->src->getName()).'Test.php',
            $this->getModule()->getTestEntityFolder()
        );
    }
}
