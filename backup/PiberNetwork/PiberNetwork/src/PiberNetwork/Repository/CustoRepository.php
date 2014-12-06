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
            'idCusto'       => 'c.idCusto',
            'idTipoCusto'   => 'tc.nome',
            'idStatusCusto' => 'sc.nome',
            'valor'         => 'c.valor',
            'dataCusto'     => 'c.dataCusto'
        );
    }

    public function getBetweenType()
    {
        return array(
        	'valor' => 'money',
            'dataCusto' => 'date'
        );
    }

    public function factory($type, $value)
    {
        switch($type) {
        	case 'money':
        	    $dateHydrator = new \Security\Hydrator\DateHydrator($this->getEntityManager());
        	    $factory = $dateHydrator->convertMoneyToDecimal($value);
        	    break;
        	case 'date':
        	    $date = \DateTime::createFromFormat('d/m/Y', $value);
        	    $factory = $date->format('Y-m-d');
        	    break;
        	default:
        	    $factory = null;
        	    break;
        }

        if (is_null($factory)) {
            throw new \Exception(sprintf('Need to configure repository factory to use between function on type %s', $type));
        }

        return $factory;

    }

    public function getWhereBetweenByType($queryBuilder, $baseName, $pre = null, $pos = null, $contParams)
    {
        $types = $this->getBetweenType();
        $baseType = $types[$baseName***REMOVED***;
        if ($pre) {
            $dataPre = $this->factory($baseType, $pre);
        }
        if ($pos) {
            $dataPos = $this->factory($baseType, $pos);
        }


        $randParam1 = $baseName.'pre'.$contParams;
        $randParam2 = $baseName.'pos'.$contParams;

        if (isset($dataPre) && !isset($dataPos)) {

            $queryBuilder->where(sprintf('%s.%s >= :%s', $this->getAliase(), $baseName, $randParam1))
            ->setParameter($randParam1, $dataPre);

        } else if (!isset($dataPre) && isset($dataPos)) {

            $queryBuilder->where(sprintf('%s.%s <= :%s', $this->getAliase(), $baseName, $randParam2))
            ->setParameter($randParam2, $dataPos);

        } else {

            $queryBuilder->where(sprintf('%s.%s BETWEEN :%s AND :%s', $this->getAliase(), $baseName, $randParam1, $randParam2))
            ->setParameter($randParam1, $dataPre)
            ->setParameter($randParam2, $dataPos);
        }



        return $queryBuilder;
    }

    public function getAliase()
    {
        return 'c';
    }

    public function selectAll($select = array(), $orderBy = null, $order = null)
    {
        $queryBuilder = $this->getRepository()->createQueryBuilder($this->getAliase());
        $queryBuilder->join($this->getAliase().'.idTipoCusto', 'tc');
        $queryBuilder->join($this->getAliase().'.idStatusCusto', 'sc');

        if (count($select)>0) {
            if (isset($select['likeField'***REMOVED***) && $select['likeField'***REMOVED*** != '') {
                $queryBuilder->where($queryBuilder->expr()->orX(
                    $queryBuilder->expr()->like('tc.nome', '?1'),
                    $queryBuilder->expr()->like('sc.nome', '?1'),
                    $queryBuilder->expr()->like('c.valor', '?1'),
                    $queryBuilder->expr()->like('c.dataCusto', '?1')
                ));
                $queryBuilder->setParameter(1, '%'.$select['likeField'***REMOVED***.'%');
            }
            unset($select['likeField'***REMOVED***, $select['submit'***REMOVED***);
            $cont = 1;


            foreach ($select as $key => $column) {
                if (substr($key, -3) == 'Pre') {

                    $replace = str_replace('Pre', 'Pos', $key);
                    $baseName = str_replace('Pos', '', $replace);
                    $pre = $column;
                    $pos = $select[$replace***REMOVED***;
                    if ($pre || $pos) {
                        $cont++;
                        $queryBuilder = $this->getWhereBetweenByType($queryBuilder, $baseName, $pre, $pos, $cont);
                    }
                    unset($select[$key***REMOVED***, $select[$replace***REMOVED***);

                } else {
                    continue;
                }
            }
            //die();

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
