<?php
namespace Column\Repository;

use Column\Repository\AbstractRepository;

class ForeignKeysRepository extends AbstractRepository
{
    public function getMapReferences()
    {
        return array(
            'idForeignKeys' => array(
                'label' => 'Foreign Keys',
                'ref' => 'fk.idForeignKeys',
                'type' => 'primary',
                'aliase' => 'fk',
                'table' => true
            ),
            'name' => array(
                'label' => 'Name',
                'ref' => 'fk.name',
                'type' => 'text',
                'aliase' => 'fk',
                'table' => true
            ),
            'createdBy' => array(
                'label' => 'Created By',
                'ref' => 'u.email',
                'type' => 'join',
                'aliase' => 'u',
                'table' => false
            ),
        );
    }

    public function getRepositoryName()
    {
        return 'Column\Entity\ForeignKeys';
    }

    public function getAliase()
    {
        return 'fk';
    }

    public function selectById($idForeignKeys)
    {
        return $this->getRepository()->findOneBy(
            array('idForeignKeys' => $idForeignKeys)
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
        $entity = new \Column\Entity\ForeignKeys();
        $entity->setCreated(new \DateTime('now'));
        $entity->setCreatedBy($this->getUser());
        $this->hydrate($data, $entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.pre', $this, $entity);
        $this->persist($entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, $entity);
        return $entity;
    }
}
