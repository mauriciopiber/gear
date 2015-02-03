<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

abstract class AbstractMvcService extends AbstractJsonService
{

    /**
     * @var \Gear\ValueObject\Src
     */
    protected $src;

    /**
     * @var \Gear\ValueObject\Db
     */
    protected $db;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var \Zend\Db\Metadata\Object\TableObject
     */
    protected $table;

    /**
     * @var string Nome da Tabela
     */
    protected $tableName;

    /**
     * @var array com campos especiais
     */
    protected $tableData;

    public function getSrc()
    {
        return $this->src;
    }

    public function setSrc($src)
    {
        $this->src = $src;
        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function setClassName($className)
    {
        $this->className = $className;
        return $this;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }



    public function setTableData(array $tableData)
    {
        $this->tableData = $tableData;
        return $this;
    }

    public function populateTableObject()
    {
        $metadata = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        try {
            $table = $metadata->getTable($this->db->getTableUnderscore());
        } catch(\Exception $e) {
            throw new \Gear\Exception\TableNotFoundException();
        }
        $this->db->setTableObject($table);
    }
}
