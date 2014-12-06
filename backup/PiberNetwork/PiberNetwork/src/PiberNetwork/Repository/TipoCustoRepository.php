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
            'idTipoCusto' => 'u.idTipoCusto',
            'idGrupoCusto' => 'g.nome',
            'nome'        => 'u.nome'
        );
    }

    public function getAliase()
    {
        return 'u';
    }

    public function selectAll($select = array(), $orderBy = null, $order = null)
    {
        $queryBuilder = $this->getRepository()->createQueryBuilder($this->getAliase());
        $queryBuilder->join($this->getAliase().'.idGrupoCusto', 'g');

        if (count($select)>0) {
            if (isset($select['likeField'***REMOVED***) && $select['likeField'***REMOVED*** != '') {
                $queryBuilder->where($queryBuilder->expr()->orX(
                    $queryBuilder->expr()->like('u.nome', '?1'),
                    $queryBuilder->expr()->like('g.nome', '?1')
                ));
                $queryBuilder->setParameter(1, '%'.$select['likeField'***REMOVED***.'%');
            }
            unset($select['likeField'***REMOVED***, $select['submit'***REMOVED***);
            $cont = 1;
            foreach ($select as $key => $column) {
                if ($column) {
                    $queryBuilder->where(sprintf('%s.%s = ?%s', $this->getAliase(), $key, $cont));
                    $queryBuilder->setParameter($cont, $column);
                    $cont++;
                }
            }
        }

        if ($orderBy) {
            $queryBuilder->orderBy($this->getOrderByMap($orderBy), $order);
        }

        $result = $queryBuilder->getQuery()->getResult();

        return $result;
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
