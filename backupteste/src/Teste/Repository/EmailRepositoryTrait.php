<?php
namespace Teste\Repository;

use Teste\Repository\EmailRepository;

trait EmailRepositoryTrait
{
    protected $emailRepository;

    public function getEmailRepository()
    {
        if (!isset($this->emailRepository)) {
            $this->emailRepository = $this->getServiceLocator()->get('Teste\Repository\EmailRepository');
        }
        return $this->emailRepository;
    }

    public function setEmailRepository(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
        return $this;
    }
}
