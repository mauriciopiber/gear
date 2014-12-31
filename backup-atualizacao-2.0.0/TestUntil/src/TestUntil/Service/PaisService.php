<?php
namespace TestUntil\Service;

use TestUntil\Service\AbstractService;
use TestUntil\Repository\PaisRepository;

class PaisService extends AbstractService
{
    /** @var $paisRepository TestUntil\Repository\Pais */
    protected $paisRepository;

    protected $sessionName;


    public function getTableHead()
    {
        $map = $this->getPaisRepository()->getMapReferences();
        return $this->getTableHeadFromMap($map);
    }

    public function getSessionName()
    {
        if (!isset($this->sessionName)) {
            $this->sessionName = 'paisSession';
        }
        return $this->sessionName;
    }

    public function setSessionName($sessionName)
    {
        $this->sessionName = $sessionName;
        return $this;
    }


    public function selectOneBy(array $data)
    {
        return $this->getPaisRepository()->selectOneBy($data);
    }


    public function selectById($idToSelect)
    {
        $repository = $this->getPaisRepository();
        return $repository->selectById($idToSelect);
    }


    public function selectAll($select = array())
    {
        $cache      = $this->getCache();
        $repository = $this->getPaisRepository();

        if ($select == null) {
            $select = array();
        }
        //var_dump($select);

        $selectCache  = $this->cacheCompare(sprintf('%sSelect', $this->getSessionName()), $select);
        $orderByCache = $this->cacheCompare(sprintf('%sOrderBy', $this->getSessionName()), $this->getOrderBy());
        $orderCache   = $this->cacheCompare(sprintf('%sOrder', $this->getSessionName()), $this->getOrder());

        if ($selectCache && $orderByCache && $orderCache) {
            //var_dump(true);
            if ($cache->hasItem(sprintf('%sResult', $this->getSessionName()))) {
                $resultSet = $cache->getItem(sprintf('%sResult', $this->getSessionName()));
            }
        }

        if (!isset($resultSet)) {
            $resultSet = $repository->selectAll($select, $this->getOrderBy(), $this->getOrder());
        }

        return $this->setSelectAllCache($resultSet);
    }

    public function setSelectAllCache($resultSet)
    {
        $cache = $this->getServiceLocator()->get('memcached');


        if ($cache->hasItem(sprintf('%sResult', $this->getSessionName()))) {
            $cache->replaceItem(sprintf('%sResult', $this->getSessionName()), $resultSet);
        } else {
            $cache->addItem(sprintf('%sResult', $this->getSessionName()), $resultSet);
        }
        return $resultSet;
    }

    public function create($data)
    {
        $repository = $this->getPaisRepository();
        $pais = $repository->insert($data);
        return $pais;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getPaisRepository();
        $pais = $repository->update($idTable, $data);
        return $pais;
    }

    public function delete($idTable)
    {
        $repository = $this->getPaisRepository();
        $pais = $repository->delete($idTable);


        return $pais;
    }



    public function setPaisRepository(PaisRepository $paisRepository)
    {
        $this->paisRepository = $paisRepository;
        return $this;
    }

    public function getPaisRepository()
    {
        if (!isset($this->paisRepository)) {
            $this->paisRepository =
                $this->getServiceLocator()->get('TestUntil\Repository\PaisRepository');
        }
        return $this->paisRepository;
    }
}
