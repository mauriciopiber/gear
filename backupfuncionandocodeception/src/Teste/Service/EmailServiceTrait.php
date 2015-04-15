<?php
namespace Teste\Service;

use Teste\Service\EmailService;

trait EmailServiceTrait
{
    protected $emailService;

    public function getEmailService()
    {
        if (!isset($this->emailService)) {
            $this->emailService = $this->getServiceLocator()->get('Teste\Service\EmailService');
        }
        return $this->emailService;
    }

    public function setEmailService(EmailService $emailService)
    {
        $this->emailService = $emailService;
        return $this;
    }
}
