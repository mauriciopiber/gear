<?php
namespace Teste\Factory;

use Teste\Factory\EmailFactory;

trait EmailFactoryTrait
{
    protected $emailFactory;

    public function getEmailFactory()
    {
        if (!isset($this->emailFactory)) {
            $this->emailFactory = $this->getServiceLocator()->get('Teste\Factory\EmailFactory');
        }
        return $this->emailFactory;
    }

    public function setEmailFactory(EmailFactory $emailFactory)
    {
        $this->emailFactory = $emailFactory;
        return $this;
    }
}
