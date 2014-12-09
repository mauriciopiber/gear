<?php
namespace PiberNetwork\Repository;

use PiberNetwork\Repository\AbstractRepository;

class PrecoTipoServicoRepository extends AbstractRepository
{
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository(
            'PiberNetwork\Entity\PrecoTipoServico'
        );
    }

    public function selectAll()
    {
        return $this->getRepository()->findAll();
    }


    public function selectByid($idPrecoTipoServico)
    {
        return $this->getRepository()->findOneBy(
            array('idPrecoTipoServico' => $idPrecoTipoServico)
        );
    }

    public function update($idTable, $data)
    {
        $entity = $this->selectByid($idTable);
        $entity->setUpdated(new \DateTime('now'));
        $this->hydrate($data, $entity);
        $this->persist($entity);
        return $entity;
    }

    public function insert($data)
    {
        $entity = new \PiberNetwork\Entity\PrecoTipoServico();
        $entity->setCreated(new \DateTime('now'));
        $this->hydrate($data, $entity);
        $this->persist($entity);
        return $entity;
    }

    public function delete($idTable)
    {
        $entity = $this->selectByid($idTable);
        if ($entity !== null) {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        }
        return $entity;
    }
}
