<?php
namespace Gear\UserType\Controller;

class LowStrict implements UserTypeControllerInterface
{
    public function getZfcAuthenticateId()
    {
        return <<<EOS
                'id'        => \$this->zfcUserAuthentication()->getIdentity()
                    ? \$this->zfcUserAuthentication()->getIdentity()->getId()
                    : null

EOS;

    }
}
