<?php
namespace Column\Service;

use GearBase\Service\AbstractService;
use GearBase\Service\PasswordVerifyTrait;
use GearImage\Service\ImagemServiceTrait;
use Column\Repository\ColumnsRepositoryTrait;

class ColumnsService extends AbstractService
{
    use PasswordVerifyTrait;
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

    public function selectAll($select = array())
    {
        $this->cache      = $this->getCache();
        $this->repository = $this->getColumnsRepository();

        return parent::selectAll($select);

    }

    public function create($data)
    {
        $repository = $this->getColumnsRepository();

        $this->createPassword('columnVarcharPasswordVerify');
        $data['columnVarcharUniqueId'***REMOVED*** = uniqid(true, true);
        $columnVarcharUpload = $this->getImageService()->overwriteImage(
            $data,
            'columns',
            'columnVarcharUploadImage'
        );

        $columns = $repository->insert($data);
        if ($columns) {
            if (isset($data['columnVarcharUploadImage'***REMOVED***)) {
                $this->getImageService()->createUploadImage(
                    $columnVarcharUpload,
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

        $this->createPassword('columnVarcharPasswordVerify');
        $data['columnVarcharUniqueId'***REMOVED*** = uniqid(true, true);
        $columnVarcharUpload = $this->getImageService()->overwriteImage(
            $data,
            'columns',
            'columnVarcharUploadImage'
        );

        $columns = $repository->update($idTable, $data);
        if ($columns) {
            if (isset($data['columnVarcharUploadImage'***REMOVED***)) {
                $this->getImageService()->updateUploadImage(
                    $columnVarcharUpload,
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


    public function selectById($idToSelect)
    {
        $repository = $this->getColumnsRepository();
        return $repository->selectById($idToSelect);
    }
}
