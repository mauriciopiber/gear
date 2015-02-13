<?php
namespace Teste\Service;

use Teste\Service\AbstractService;
use Teste\Repository\EmailRepository;

class EmailService extends AbstractService
{
    /** @var $emailRepository Teste\Repository\Email */
    protected $emailRepository;


    protected $sessionName;

    protected $authService;

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
        return $repository->selectById($idToSelect);
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



    public function setEmailRepository(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
        return $this;
    }

    public function getEmailRepository()
    {
        if (!isset($this->emailRepository)) {
            $this->emailRepository =
                $this->getServiceLocator()->get('Teste\Repository\EmailRepository');
        }
        return $this->emailRepository;
    }
}
