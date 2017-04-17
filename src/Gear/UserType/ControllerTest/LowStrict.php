<?php
namespace Gear\UserType\ControllerTest;

class LowStrict implements UserTypeControllerTestInterface
{
    public function getMockZfcAuthenticate()
    {
        return <<<EOS


        \$this->zfcUserMock = \$this->createMock('GearAdmin\Entity\User');

        \$this->zfcUserMock->expects(\$this->any())
            ->method('getId')
            ->will(\$this->returnValue('1'));

        \$this->auth = \$this->createMock('ZfcUser\Controller\Plugin\ZfcUserAuthentication');

        \$this->auth->expects(\$this->any())
            ->method('hasIdentity')
            ->will(\$this->returnValue(true));

        \$this->auth->expects(\$this->any())
            ->method('getIdentity')
            ->will(\$this->returnValue(\$this->zfcUserMock));

        \$this->controller->getPluginManager()
            ->setService('zfcUserAuthentication', \$this->auth);
EOS;
    }
}
