<?php
namespace TestUntil\Repository;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator as DoctrineHydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

abstract class AbstractRepository implements
    ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $entityManager;


    protected $query;

    protected $where;

    protected $filter;

    protected $orderBy;

    protected $order;

    protected $cont;

    abstract public function getMapReferences();

    abstract public function getAliase();

    /**
     * Função responsável por buscar o user que será vinculado à tabela ao salvar e atualizar.
     */
    public function getUser()
    {
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        $hydrator = new DoctrineObject($this->getEntityManager());
        $user = new \TestUntil\Entity\User();
        $user = $hydrator->hydrate($hydrator->extract($auth->getIdentity()), $user);
        return $user;
    }

    /**
     * Função responsável por buscar os dados diretamente no banco.
     * @param unknown $select
     * @param string $orderBy
     * @param string $order
     * @return unknown
     */
    public function selectAll($select = array(), $orderBy = null, $order = null)
    {
        unset($select['submit'***REMOVED***);

        $this->cont    = 1;
        $this->filter  = $select;
        $this->orderBy = $orderBy;
        $this->order   = $order;
        $this->query   = $this->getRepository()->createQueryBuilder($this->getAliase());
        $this->where   = false;

        $this->setUpJoin();
        if (count($this->filter)>0) {
            if ($this->hasLikeFilter()) {
                $this->setUpLike();
            }
            unset($this->filter['likeField'***REMOVED***);
            $this->setUpBetween();
            $this->setUpWhere();
        }
        $this->setUpOrder();

        $result = $this->query->getQuery()->getResult();

        return $result;
    }

    /**
     * Função responsável por criar o a clausula Like-Where a partir do getMapReferences.
     */
    public function setUpLike()
    {

        $data = $this->getMapReferences();

        $orWhere = $this->query->expr()->orx();

        foreach ($data as $item) {
            $orWhere->add($this->query->expr()->like($item['ref'***REMOVED***, '?1'));
        }
        $this->query->where($orWhere);

        $this->query->setParameter(1, '%'.$this->filter['likeField'***REMOVED***.'%');
        $this->where = true;
    }

    /**
     * Função responsável por criar os joins da query a partir do getMapReferences
     */
    public function setUpJoin()
    {
        $mapping = $this->getMapReferences();
        foreach ($mapping as $name => $map) {
            if ($map['type'***REMOVED*** == 'join') {
                $this->query->join(sprintf('%s.%s', $this->getAliase(), $name), $map['aliase'***REMOVED***);
            }
        }
    }

    /**
     * Função responsável por verificar se necessita verificação de busca com Like.
     * @return boolean
     */
    public function hasLikeFilter()
    {
        return (isset($this->filter['likeField'***REMOVED***) && $this->filter['likeField'***REMOVED*** != '');
    }

    /**
     * Função responsável por criar as clausulas Between-Where a partir do getMapReferences.
     * Definir especialidades no getMapReferences.
     * Remover as referencias do filtro após realizado.
     */
    public function setUpBetween()
    {
        foreach ($this->filter as $key => $column) {
            if (substr($key, -3) == 'Pre') {

                $replace = str_replace('Pre', 'Pos', $key);
                $baseName = str_replace('Pos', '', $replace);
                $pre = $column;
                $pos = $this->filter[$replace***REMOVED***;
                if ($pre || $pos) {

                    $this->cont++;
                    $this->getWhereBetweenByType($baseName, $pre, $pos);
                    $this->where = true;
                }

                unset($this->filter[$key***REMOVED***, $this->filter[$replace***REMOVED***);

            } else {
                continue;
            }
        }
    }

    /**
     * Função responsável por criar as clausulas where onde há joins nas tabelas.
     */
    public function setUpWhere()
    {

        foreach ($this->filter as $key => $column) {
            if ($column != '') {

                if ($this->where == true) {
                    $this->query->andWhere(sprintf('%s.%s = ?%s', $this->getAliase(), $key, $this->cont));
                } else {
                    $this->where = true;
                    $this->query->where(sprintf('%s.%s = ?%s', $this->getAliase(), $key, $this->cont));
                }


                $this->query->setParameter($this->cont, $column);
                $this->cont++;
            }
        }
    }

    /**
     * Função que retorna o tipo apartir do nome do campo para criação da clausula between.
     * @param string $type
     */
    public function getBetweenType($type)
    {
        $data = $this->getMapReferences();

        return $data[$type***REMOVED***['type'***REMOVED***;
    }

    /**
     * Função que cria uma linha que compara os campos onde há necessidade de Between.
     * @param string $baseName
     * @param string $pre
     * @param string $pos
     */
    public function getWhereBetweenByType($baseName, $pre = null, $pos = null)
    {
        $baseType = $this->getBetweenType($baseName);

        if ($pre != '') {
            $dataPre = $this->factory($baseType, $pre);
        }
        if ($pos != '') {
            $dataPos = $this->factory($baseType, $pos);
        }

        $randParam1 = $baseName.'pre'.$this->cont;
        $randParam2 = $baseName.'pos'.$this->cont;

        if (isset($dataPre) && !isset($dataPos)) {
            $dql = sprintf('%s.%s >= :%s', $this->getAliase(), $baseName, $randParam1);
            $this->query->setParameter($randParam1, $dataPre);

        } elseif (!isset($dataPre) && isset($dataPos)) {
            $dql = sprintf('%s.%s <= :%s', $this->getAliase(), $baseName, $randParam2);
            $this->query->setParameter($randParam2, $dataPos);

        } else {
            $dql = sprintf('%s.%s BETWEEN :%s AND :%s', $this->getAliase(), $baseName, $randParam1, $randParam2);
            $this->query->setParameter($randParam1, $dataPre);
            $this->query->setParameter($randParam2, $dataPos);
        }

        if ($this->where == true) {
            $this->query->andWhere($dql);
        } else {
            $this->where = true;
            $this->query->where($dql);
        }
    }

    /**
     * Função responsável por criar a clausula Order na query.
     */
    public function setUpOrder()
    {
        if ($this->orderBy) {
            $this->query->orderBy($this->getOrderByMap($this->orderBy), $this->order);
        }
    }

    public function selectOneBy(array $data)
    {
        return $this->getRepository()->findOneBy($data);
    }

    public function delete($idTable)
    {
        $entity = $this->selectByid($idTable);
        if ($entity !== null) {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
            return true;
        } else {
            return false;
        }
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
            throw new \Exception(
                sprintf(
                    'Need to configure repository factory to use between function on type %s',
                    $type
                )
            );
        }
        return $factory;
    }

    public function getOrderByMap($order)
    {
        if (array_key_exists($order, $this->getMapReferences())) {
            return $this->getMapReferences()[$order***REMOVED***['ref'***REMOVED***;
        } else {
            throw new \Exception('Order by not configured right way');
        }
    }

    public function persist($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function hydrate($data, $entity)
    {
        $hydrator = new DoctrineHydrator($this->getEntityManager());
        $hydrator->hydrate($data, $entity);
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        if (!isset($this->entityManager)) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }

	public function getQuery()
	{
		return $this->query;
	}

	public function setQuery($query)
	{
		$this->query = $query;
		return $this;
	}

	public function getFilter()
	{
		return $this->filter;
	}

	public function setFilter($filter)
	{
		$this->filter = $filter;
		return $this;
	}
}
