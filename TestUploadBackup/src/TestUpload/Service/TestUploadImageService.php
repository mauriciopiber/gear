<?php
namespace TestUpload\Service;

use TestUpload\Service\AbstractService;
use TestUpload\Repository\TestUploadImageRepositoryTrait;

class TestUploadImageService extends AbstractService
{
    use TestUploadImageRepositoryTrait;

    protected $sessionName;

    protected $authService;

    public function getTableHead()
    {
        $map = $this->getTestUploadImageRepository()->getMapReferences();
        return $this->getTableHeadFromMap($map);
    }

    public function getSessionName()
    {
        if (!isset($this->sessionName)) {
            $this->sessionName = 'testUploadImageSession';
        }
        return $this->sessionName;
    }

    public function selectOneBy(array $data)
    {
        return $this->getTestUploadImageRepository()->selectOneBy($data);
    }

    public function selectById($idToSelect)
    {
        $repository = $this->getTestUploadImageRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll($select = array())
    {
        $cache      = $this->getCache();
        $repository = $this->getTestUploadImageRepository();

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
            $data[$key***REMOVED*** = $this->getImageService()->defineLocation($data[$key***REMOVED***, 'test-upload-image-'.$key);
            return $fileArray;
        } else {
            unset($data[$key***REMOVED***);
        }
    }

    public function create($data)
    {
        $repository = $this->getTestUploadImageRepository();
        $image = $this->overwriteImage($data, 'image');

        $testUploadImage = $repository->insert($data);
        if ($testUploadImage) {
            if (isset($data['image'***REMOVED***)) {
                $this->getImageService()->createUploadImage(
                    $image,
                    'test-upload-image-image',
                    $data['image'***REMOVED***
                );
            }
            $this->clearCache();
        }
        return $testUploadImage;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getTestUploadImageRepository();
        $image = $this->overwriteImage($data, 'image');
        $testUploadImage = $repository->update($idTable, $data);
        if ($testUploadImage) {
            if (isset($data['image'***REMOVED***)) {
                $this->getImageService()->updateUploadImage(
                    $image,
                    'test-upload-image-image',
                    $data['image'***REMOVED***
                );
            }
            $this->clearCache();
        }
        return $testUploadImage;
    }

    public function delete($idTable)
    {
        $entity = $this->selectById($idTable);

        if (!$entity) {
            return false;
        }

        $repository = $this->getTestUploadImageRepository();
        $testUploadImage = $repository->delete($entity);

        if ($testUploadImage) {
            $this->getImageService()->deleteUploadImage($idTable, 'test-upload-image');
            $this->clearCache();
        }
        return $testUploadImage;
    }

    public function extract(\TestUpload\Entity\TestUploadImage $data)
    {
        $repository = $this->getTestUploadImageRepository();
        return $repository->extract($data);
    }

    public function getImageService()
    {
        if (!isset($this->imagemService)) {
            $this->imagemService =
            $this->getServiceLocator()->get('ImagemUpload\Service\ImagemService');
        }
        return $this->imagemService;
    }
}
