<?php
namespace PiberNetwork\Repository;

use PiberNetwork\Repository\AbstractRepository;

class TipoCustoRepository extends AbstractRepository
{
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository('PiberNetwork\Entity\TipoCusto');
    }

    public function getMapReferences()
    {
        return array(
            'idTipoCusto' => array('ref' => 'u.idTipoCusto', 'type' => 'primary'),
            'idGrupoCusto' => array('ref' => 'g.nome', 'type' => 'join', 'aliase' => 'g'),
            'nome'        => array('ref' => 'u.nome', 'type' => 'varchar')
        );
    }

    public function getAliase()
    {
        return 'u';
    }

    public function selectByid($idTipoCusto)
    {
        return $this->getRepository()->findOneBy(
            array('idTipoCusto' => $idTipoCusto)
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
        $entity = new \PiberNetwork\Entity\TipoCusto();
        $entity->setCreated(new \DateTime('now'));
        $this->hydrate($data, $entity);
        $this->persist($entity);
        return $entity;
    }
}
