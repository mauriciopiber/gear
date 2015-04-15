<?php
namespace Teste\Service;

use Teste\Service\AbstractService;
use Teste\Repository\EmailRepositoryTrait;

class EmailService extends AbstractService
{
    use EmailRepositoryTrait;

    protected $sessionName;

    protected $authService;

    public function setAuthService($authService)
    {
        $this->authService = $authService;
    }

    public function getAuthService()
    {
        if (!$this->authService) {
            $this->authService = $this->getServiceLocator()->get('zfcuser_auth_service');
        }
        return $this->authService;
    }

    public function getTableHead()
    {
        $map = $this->getEmailRepository()->getMapReferences();
        return $this->getTableHeadFromMap($map);
    }

    public function getSessionName()
    {
        if (!isset($this->sessionName)) {
            $this->sessionName = 'emailSession';
        }
        return $this->sessionName;
    }

    public function selectOneBy(array $data)
    {
        return $this->getEmailRepository()->selectOneBy($data);
    }

    public function selectById($idToSelect)
    {
        $repository = $this->getEmailRepository();

        $entity = $repository->selectById($idToSelect);

        if (!$this->getAuthService()->hasIdentity() || !$entity) {
            return null;
        }

        if ($entity->getCreatedBy()->getIdUser() === $this->getAuthService()->getIdentity()->getIdUser()) {
            return $entity;
        }

        return null;
    }

    public function selectViewById($idToSelect)
    {
        $repository = $this->getEmailRepository();
        $entity = $repository->selectById($idToSelect);
        return $entity;
    }

    public function selectAll($select = array())
    {
        $cache      = $this->getCache();
        $repository = $this->getEmailRepository();

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
        $repository = $this->getEmailRepository();
        $email = $repository->insert($data);
        if ($email) {
            $this->clearCache();
        }
        return $email;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getEmailRepository();
        $email = $repository->update($idTable, $data);
        if ($email) {
            $this->clearCache();
        }
        return $email;
    }

    public function delete($idTable)
    {
        $entity = $this->selectById($idTable);

        if (!$entity) {
            return false;
        }

        $repository = $this->getEmailRepository();
        $email = $repository->delete($entity);


        if ($email) {
            $this->clearCache();
        }
        return $email;
    }

    public function extract(\Teste\Entity\Email $data)
    {
        $repository = $this->getEmailRepository();
        return $repository->extract($data);
    }

}
