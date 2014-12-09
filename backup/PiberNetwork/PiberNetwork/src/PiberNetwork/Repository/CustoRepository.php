<?php
namespace PiberNetwork\Repository;

use PiberNetwork\Repository\AbstractRepository;

class CustoRepository extends AbstractRepository
{
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository('PiberNetwork\Entity\Custo');
    }

    public function getMapReferences()
    {
        return array(
            'idCusto'       => array('ref' => 'c.idCusto', 'type' => 'primary'),
            'idTipoCusto'   => array('ref' => 'tc.nome', 'type' => 'join', 'aliase' => 'tc'),
            'idStatusCusto' => array('ref' => 'sc.nome', 'type' => 'join', 'aliase' => 'sc'),
            'valor'         => array('ref' => 'c.valor', 'type' => 'money'),
            'dataCusto'     => array('ref' => 'c.dataCusto', 'type' => 'date')
        );
    }

    public function getAliase()
    {
        return 'c';
    }

    public function selectByid($idCusto)
    {
        return $this->getRepository()->findOneBy(
            array('idCusto' => $idCusto)
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
        $entity = new \PiberNetwork\Entity\Custo();
        $entity->setCreated(new \DateTime('now'));
        $this->hydrate($data, $entity);
        $this->persist($entity);
        return $entity;
    }
}
