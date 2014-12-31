<?php
namespace TestUntil\Repository;

use TestUntil\Repository\AbstractRepository;

class PaisRepository extends AbstractRepository
{
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository('TestUntil\Entity\Pais');
    }

    public function getMapReferences()
    {
        return array(
            'idPais' => array(
                'label' => 'Pais',
                'ref' => 'p.idPais',
                'type' => 'primary',
                'aliase' => 'p',
                'table' => true
            ),
            'nome' => array(
                'label' => 'Nome',
                'ref' => 'p.nome',
                'type' => 'text',
                'aliase' => 'p',
                'table' => true
            ),
        );
    }

    public function getAliase()
    {
        return 'p';
    }

    public function selectByid($idPais)
    {
        return $this->getRepository()->findOneBy(
            array('idPais' => $idPais)
        );
    }

    public function update($idTable, $data)
    {
        $entity = $this->selectByid($idTable);
        $entity->setUpdated(new \DateTime('now'));
        $entity->setUpdatedBy($this->getUser());
        $this->hydrate($data, $entity);
        $this->persist($entity);
        return $entity;
    }

    public function insert($data)
    {
        $entity = new \TestUntil\Entity\Pais();
        $entity->setCreated(new \DateTime('now'));
        $entity->setCreatedBy($this->getUser());
        $this->hydrate($data, $entity);
        $this->persist($entity);
        return $entity;
    }

}
