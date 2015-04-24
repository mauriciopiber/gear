<?php
namespace Column\Service;

use GearBase\Service\AbstractService;
use ImagemUpload\Service\ImagemServiceTrait;
use Column\Repository\ColumnsRepositoryTrait;

class ColumnsService extends AbstractService
{
    use ImagemServiceTrait;
    use ColumnsRepositoryTrait;

    protected $sessionName;

    protected $authService;

    public function getTableHead()
    {
        $map = $this->getColumnsRepository()->getMapReferences();
        return $this->getTableHeadFromMap($map);
    }

    public function getSessionName()
    {
        if (!isset($this->sessionName)) {
            $this->sessionName = 'columnsSession';
        }
        return $this->sessionName;
    }

    public function selectOneBy(array $data)
    {
        return $this->getColumnsRepository()->selectOneBy($data);
    }

    public function selectById($idToSelect)
    {
        $repository = $this->getColumnsRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll($select = array())
    {
        $cache      = $this->getCache();
        $repository = $this->getColumnsRepository();

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


    public function overwriteImage(&$data, $key)
    {
        if ($data[$key***REMOVED*** !== null) {
            $fileArray = $data[$key***REMOVED***;
            $data[$key***REMOVED*** = $this->getImageService()->defineLocation($data[$key***REMOVED***, 'columns-'.$key);
            return $fileArray;
        } else {
            unset($data[$key***REMOVED***);
        }
    }

    public function create($data)
    {
        $repository = $this->getColumnsRepository();
        $columnVarcharUploadImage = $this->overwriteImage($data, 'columnVarcharUploadImage');
        if (!empty($data['columnVarcharPasswordVerify'***REMOVED***)) {
            $bcrypt = new \Zend\Crypt\Password\Bcrypt();
            $bcrypt->setCost(14);
            $data['columnVarcharPasswordVerify'***REMOVED*** = $bcrypt->create($data['columnVarcharPasswordVerify'***REMOVED***);
        } else {
            unset($data['columnVarcharPasswordVerify'***REMOVED***);
        }
        $data['columnVarcharUniqueId'***REMOVED*** = uniqid(true, true);
        $columns = $repository->insert($data);
        if ($columns) {
            if (isset($data['columnVarcharUploadImage'***REMOVED***)) {
                $this->getImageService()->createUploadImage(
                    $columnVarcharUploadImage,
                    'columns-columnVarcharUploadImage',
                    $data['columnVarcharUploadImage'***REMOVED***
                );
            }
            $this->clearCache();
        }
        return $columns;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getColumnsRepository();
        $columnVarcharUploadImage = $this->overwriteImage($data, 'columnVarcharUploadImage');
        if (!empty($data['columnVarcharPasswordVerify'***REMOVED***)) {
            $bcrypt = new \Zend\Crypt\Password\Bcrypt();
            $bcrypt->setCost(14);
            $data['columnVarcharPasswordVerify'***REMOVED*** = $bcrypt->create($data['columnVarcharPasswordVerify'***REMOVED***);
        } else {
            unset($data['columnVarcharPasswordVerify'***REMOVED***);
        }
        $data['columnVarcharUniqueId'***REMOVED*** = uniqid(true, true);
        $columns = $repository->update($idTable, $data);
        if ($columns) {
            if (isset($data['columnVarcharUploadImage'***REMOVED***)) {
                $this->getImageService()->updateUploadImage(
                    $columnVarcharUploadImage,
                    'columns-columnVarcharUploadImage',
                    $data['columnVarcharUploadImage'***REMOVED***
                );
            }
            $this->clearCache();
        }
        return $columns;
    }

    public function delete($idTable)
    {
        $entity = $this->selectById($idTable);

        if (!$entity) {
            return false;
        }

        $repository = $this->getColumnsRepository();
        $columns = $repository->delete($entity);


        if ($columns) {
            $this->getImageService()->deleteUploadImage($idTable, 'columns');
            $this->clearCache();
        }
        return $columns;
    }

    public function extract(\Column\Entity\Columns $data)
    {
        $repository = $this->getColumnsRepository();
        return $repository->extract($data);
    }
}
