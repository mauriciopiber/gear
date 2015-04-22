<?php
namespace Column\Repository;

use Column\Repository\AbstractRepository;

class ColumnsRepository extends AbstractRepository
{
    public function getMapReferences()
    {
        return array(
            'idColumns' => array(
                'label' => 'Columns',
                'ref' => 'c.idColumns',
                'type' => 'primary',
                'aliase' => 'c',
                'table' => true
            ),
            'columnDate' => array(
                'label' => 'Column Date',
                'ref' => 'c.columnDate',
                'type' => 'date',
                'aliase' => 'c',
                'table' => true
            ),
            'columnDatetime' => array(
                'label' => 'Column Datetime',
                'ref' => 'c.columnDatetime',
                'type' => 'date',
                'aliase' => 'c',
                'table' => true
            ),
            'columnTime' => array(
                'label' => 'Column Time',
                'ref' => 'c.columnTime',
                'type' => 'date',
                'aliase' => 'c',
                'table' => true
            ),
            'columnInt' => array(
                'label' => 'Column Int',
                'ref' => 'c.columnInt',
                'type' => 'int',
                'aliase' => 'c',
                'table' => true
            ),
            'columnTinyint' => array(
                'label' => 'Column Tinyint',
                'ref' => 'c.columnTinyint',
                'type' => 'int',
                'aliase' => 'c',
                'table' => true
            ),
            'columnDecimal' => array(
                'label' => 'Column Decimal',
                'ref' => 'c.columnDecimal',
                'type' => 'money',
                'aliase' => 'c',
                'table' => true
            ),
            'columnVarchar' => array(
                'label' => 'Column Varchar',
                'ref' => 'c.columnVarchar',
                'type' => 'text',
                'aliase' => 'c',
                'table' => true
            ),
            'columnLongtext' => array(
                'label' => 'Column Longtext',
                'ref' => 'c.columnLongtext',
                'type' => 'text',
                'aliase' => 'c',
                'table' => true
            ),
            'columnText' => array(
                'label' => 'Column Text',
                'ref' => 'c.columnText',
                'type' => 'text',
                'aliase' => 'c',
                'table' => false
            ),
            'createdBy' => array(
                'label' => 'Created By',
                'ref' => 'u.email',
                'type' => 'join',
                'aliase' => 'u',
                'table' => false
            ),
            'columnDatetimePtBr' => array(
                'label' => 'Column Datetime Pt Br',
                'ref' => 'c.columnDatetimePtBr',
                'type' => 'date',
                'aliase' => 'c',
                'table' => false
            ),
            'columnDatePtBr' => array(
                'label' => 'Column Date Pt Br',
                'ref' => 'c.columnDatePtBr',
                'type' => 'date',
                'aliase' => 'c',
                'table' => false
            ),
            'columnDecimalPtBr' => array(
                'label' => 'Column Decimal Pt Br',
                'ref' => 'c.columnDecimalPtBr',
                'type' => 'money',
                'aliase' => 'c',
                'table' => false
            ),
            'columnIntCheckbox' => array(
                'label' => 'Column Int Checkbox',
                'ref' => 'c.columnIntCheckbox',
                'type' => 'int',
                'aliase' => 'c',
                'table' => false
            ),
            'columnTinyintCheckbox' => array(
                'label' => 'Column Tinyint Checkbox',
                'ref' => 'c.columnTinyintCheckbox',
                'type' => 'int',
                'aliase' => 'c',
                'table' => false
            ),
            'columnVarcharEmail' => array(
                'label' => 'Column Varchar Email',
                'ref' => 'c.columnVarcharEmail',
                'type' => 'text',
                'aliase' => 'c',
                'table' => true
            ),
            'columnVarcharPasswordVerify' => array(
                'label' => 'Column Varchar Password Verify',
                'ref' => 'c.columnVarcharPasswordVerify',
                'type' => 'text',
                'aliase' => 'c',
                'table' => false
            ),
            'columnVarcharUniqueId' => array(
                'label' => 'Column Varchar Unique',
                'ref' => 'c.columnVarcharUniqueId',
                'type' => 'text',
                'aliase' => 'c',
                'table' => false
            ),
            'columnVarcharUploadImage' => array(
                'label' => 'Column Varchar Upload Image',
                'ref' => 'c.columnVarcharUploadImage',
                'type' => 'text',
                'aliase' => 'c',
                'table' => false
            ),
            'columnForeignKey' => array(
                'label' => 'Column Foreign Key',
                'ref' => 'fk.name',
                'type' => 'join',
                'aliase' => 'fk',
                'table' => true
            ),
        );
    }

    public function getRepositoryName()
    {
        return 'Column\Entity\Columns';
    }

    public function getAliase()
    {
        return 'c';
    }

    public function selectById($idColumns)
    {
        return $this->getRepository()->findOneBy(
            array('idColumns' => $idColumns)
        );
    }

    public function update($idTable, $data)
    {
        $entity = $this->selectById($idTable);
        $entity->setUpdated(new \DateTime('now'));
        $entity->setUpdatedBy($this->getUser());
        $this->hydrate($data, $entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.pre', $this, $entity);
        $this->persist($entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, $entity);
        return $entity;
    }

    public function insert($data)
    {
        $entity = new \Column\Entity\Columns();
        $entity->setCreated(new \DateTime('now'));
        $entity->setCreatedBy($this->getUser());
        $this->hydrate($data, $entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.pre', $this, $entity);
        $this->persist($entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, $entity);
        return $entity;
    }
}
