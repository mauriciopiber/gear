<?php
namespace Teste\Filter;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

abstract class AbstractFilter extends InputFilter implements
    ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    protected $translate;

    public function getTranslate()
    {
        if (!isset($this->translate)) {
            $this->translate = $this->getServiceLocator()->get('translator');
        }
        return $this->translate;
    }

    public function setTranslate($translate)
    {
        $this->translate = $translate;
        return $this;
    }


    public function getEmailAddressValidator($entity)
    {
        $message = sprintf(
            $this->getTranslate()->translate(
                '%s não corresponde há um padrão válido, por favor confira se está escrito corretamente'
            ),
            $entity
        );

        return array(
            'name' => 'EmailAddress',
            'options' => array(
                'messages' => array(
                    \Zend\Validator\EmailAddress::INVALID            => $message,
                    \Zend\Validator\EmailAddress::INVALID_FORMAT     => $message,
                    \Zend\Validator\EmailAddress::INVALID_HOSTNAME   => $message,
                    \Zend\Validator\EmailAddress::INVALID_MX_RECORD  => $message,
                    \Zend\Validator\EmailAddress::INVALID_SEGMENT    => $message,
                    \Zend\Validator\EmailAddress::DOT_ATOM           => $message,
                    \Zend\Validator\EmailAddress::QUOTED_STRING      => $message,
                    \Zend\Validator\EmailAddress::INVALID_LOCAL_PART => $message,
                    \Zend\Validator\EmailAddress::LENGTH_EXCEEDED    => $message,
                ),
            ),
            'break_chain_on_failure' => true
        );
    }

    public function getNotEmptyValidator($entity)
    {
        return array(
            'name' => 'NotEmpty',
            'options' => array(
                'messages' => array(
                    \Zend\Validator\NotEmpty::IS_EMPTY =>
                    sprintf(
                        $this->getTranslate()->translate('%s é obrigatório, por favor preencha para continuar.'),
                        $this->getTranslate()->translate($entity)
                    )
                ),
            ),
            'break_chain_on_failure' => true
        );
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
