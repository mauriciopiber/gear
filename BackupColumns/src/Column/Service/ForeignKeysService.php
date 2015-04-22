<?php
namespace Column\Service;

use Column\Service\AbstractService;
use Column\Repository\ForeignKeysRepositoryTrait;


class ForeignKeysService extends AbstractService
{
    use ForeignKeysRepositoryTrait;


    protected $sessionName;

    protected $authService;

    public function getTableHead()
    {
        $map = $this->getForeignKeysRepository()->getMapReferences();
        return $this->getTableHeadFromMap($map);
    }

    public function getSessionName()
    {
        if (!isset($this->sessionName)) {
            $this->sessionName = 'foreignKeysSession';
        }
        return $this->sessionName;
    }

    public function selectOneBy(array $data)
    {
        return $this->getForeignKeysRepository()->selectOneBy($data);
    }

    public function selectById($idToSelect)
    {
        $repository = $this->getForeignKeysRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll($select = array())
    {
        $cache      = $this->getCache();
        $repository = $this->getForeignKeysRepository();

        if ($select == null) {
            $select = array();
        }

        $selectCache  = $this->cacheCompare(sprintf('%sSelect', $this->getSessionName()), $select);
        $orderByCache = $this->cacheCompare(sprintf('%sOrderBy', $this->getSessionName()), $this->getOrderBy());
        $orderCache   = $this->cacheCompare(sprintf('%sOrder', $this->getSessionName()), $this->getOrder());

        if ($selectCache && $orderByCache && $orderCache) {
            if ($cache->hasItem(sprintf('%sResult', $this->getSessionName()))) {
                $resultSet = $cache->getItem(sprintf('%sResult', $this->getSessionName()));
            }
        }
        if (!isset($resultSet)) {
            $resultSet = $repository->selectAll($select, $this->getOrderBy(), $this->getOrder());
        }
        return $this->setSelectAllCache($resultSet);
    }


    public function create($data)
    {
        $repository = $this->getForeignKeysRepository();
        $foreignKeys = $repository->insert($data);
        if ($foreignKeys) {
            $this->clearCache();
        }
        return $foreignKeys;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getForeignKeysRepository();
        $foreignKeys = $repository->update($idTable, $data);
        if ($foreignKeys) {
            $this->clearCache();
        }
        return $foreignKeys;
    }

    public function delete($idTable)
    {
        $entity = $this->selectById($idTable);

        if (!$entity) {
            return false;
        }

        $repository = $this->getForeignKeysRepository();
        $foreignKeys = $repository->delete($entity);


        if ($foreignKeys) {
            $this->clearCache();
        }
        return $foreignKeys;
    }

    public function extract(\Column\Entity\ForeignKeys $data)
    {
        $repository = $this->getForeignKeysRepository();
        return $repository->extract($data);
    }
}
