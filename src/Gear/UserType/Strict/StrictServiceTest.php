<?php
namespace Gear\UserType\Strict;

use Gear\UserType\UserTypeServiceTestInterface;

class StrictServiceTest implements UserTypeServiceTestInterface
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
        \$entity = \$this->prophesize('{$module}\Entity\\$class');
        \$entity->getId{$class}()->willReturn(31);

        \$this->repository->selectById(31)->willReturn(\$entity->reveal())->shouldBeCalled();
        \$this->repository->deleteSafe(\$entity->reveal())->willReturn(true)->shouldBeCalled();

        \$this->service->setCache(\$this->cache->reveal());

        \$resultSet = \$this->service->delete(31);
        \$this->assertTrue(\$resultSet);
    }

EOS;


    }
}
