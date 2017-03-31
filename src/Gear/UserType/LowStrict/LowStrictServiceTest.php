<?php
namespace Gear\UserType\LowStrict;

use Gear\UserType\UserTypeServiceTestInterface;

class LowStrictServiceTest implements UserTypeServiceTestInterface
{
    public function renderSelectByIdNull()
    {
        return <<<EOS

    public function testSelectByIdAnotherUserReturnNull()
    {
        \$resultSet = \$this->service->selectById(30);
        \$this->assertNull(\$resultSet);
    }

EOS;

    }


    public function renderDelete(array $options)
    {
        $module = $options['module'***REMOVED***;
        $class = $options['class'***REMOVED***;

        return <<<EOS

    /**
     * @group service.delete
     */
    public function testDelete()
    {
        \$this->user = \$this->prophesize('GearAdmin\Entity\User');
        \$this->user->getIdUser()->willReturn(1)->shouldBeCalled();

        \$this->auth->hasIdentity()->willReturn(true)->shouldBeCalled();
        \$this->auth->getIdentity()->willReturn(\$this->user->reveal())->shouldBeCalled();

        \$this->entity = \$this->prophesize('{$module}\Entity\\$class');
        \$this->entity->getId{$class}()->willReturn(31);
        \$this->entity->getCreatedBy()->willReturn(\$this->user->reveal());

        \$this->repository->selectById(31)->willReturn(\$this->entity->reveal())->shouldBeCalled();
        \$this->repository->deleteSafe(\$this->entity->reveal())->willReturn(true)->shouldBeCalled();

        \$this->service->setCache(\$this->cache->reveal());

        \$resultSet = \$this->service->delete(31);
        \$this->assertTrue(\$resultSet);
    }

EOS;


    }
}
