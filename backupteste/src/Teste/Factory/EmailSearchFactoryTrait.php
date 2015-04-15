<?php
namespace Teste\Factory;

use Teste\Factory\EmailSearchFactory;

trait EmailSearchFactoryTrait
{
    protected $emailSearchFactory;

    public function getEmailSearchFactory()
    {
        if (!isset($this->emailSearchFactory)) {
            $this->emailSearchFactory = $this->getServiceLocator()->get('Teste\Form\Search\EmailSearchForm');
        }
        return $this->emailSearchFactory;
    }

    public function setEmailSearchFactory(EmailSearchFactory $emailSearchFactory)
    {
        $this->emailSearchFactory = $emailSearchFactory;
        return $this;
    }
}
