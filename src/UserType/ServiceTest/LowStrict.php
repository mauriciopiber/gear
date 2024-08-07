<?php
namespace Gear\UserType\ServiceTest;

use Gear\UserType\ServiceTest\UserTypeServiceTestInterface;

class LowStrict implements UserTypeServiceTestInterface
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

        \$this->zfcuserAuthService->hasIdentity()->willReturn(true)->shouldBeCalled();
        \$this->zfcuserAuthService->getIdentity()->willReturn(\$this->user->reveal())->shouldBeCalled();

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

    public function renderSelectViewById(array $options)
    {
        $module = $options['module'***REMOVED***;
        $class = $options['class'***REMOVED***;

        return <<<EOS

    public function testSelectViewById()
    {
        \$this->entity = \$this->prophesize('{$module}\Entity\\$class');
        \$this->entity->getId{$class}()->willReturn(1);
        \$this->repository->selectById(1)->willReturn(\$this->entity->reveal())->shouldBeCalled();

        \$resultSet = \$this->service->selectViewById(1);
        \$this->assertInstanceOf('{$module}\Entity\\$class', \$resultSet);
        \$this->assertEquals(1, \$resultSet->getId{$class}());
    }

EOS;
    }

    public function renderSelectByIdReturnInvalid(array $options)
    {
        $module = $options['module'***REMOVED***;
        $class = $options['class'***REMOVED***;

        return <<<EOS

    public function testSelect{$class}ByIdWithoutPermissionsReturnNull()
    {
        \$this->user = \$this->prophesize('GearAdmin\Entity\User');
        \$this->user->getIdUser()->willReturn(1)->shouldBeCalled();

        \$this->zfcuserAuthService->hasIdentity()->willReturn(true)->shouldBeCalled();
        \$this->zfcuserAuthService->getIdentity()->willReturn(\$this->user->reveal())->shouldBeCalled();

        \$this->entity = \$this->prophesize('{$module}\Entity\\$class');
        \$this->entity->getId{$class}()->willReturn(1);

        \$this->creator = \$this->prophesize('GearAdmin\Entity\User');
        \$this->creator->getIdUser()->willReturn(2)->shouldBeCalled();

        \$this->entity->getCreatedBy()->willReturn(\$this->creator->reveal())->shouldBeCalled();

        \$this->repository->selectById(1)->willReturn(\$this->entity->reveal())->shouldBeCalled();

        \$this->assertNull(\$this->service->selectById(1));
    }

EOS;
    }

    public function renderSelectById(array $options)
    {
        $module = $options['module'***REMOVED***;
        $class = $options['class'***REMOVED***;
        return <<<EOS

    public function testSelectById()
    {
        \$this->user = \$this->prophesize('GearAdmin\Entity\User');
        \$this->user->getIdUser()->willReturn(1)->shouldBeCalled();

        \$this->zfcuserAuthService->hasIdentity()->willReturn(true)->shouldBeCalled();
        \$this->zfcuserAuthService->getIdentity()->willReturn(\$this->user->reveal())->shouldBeCalled();

        \$this->entity = \$this->prophesize('{$module}\Entity\\$class');
        \$this->entity->getId{$class}()->willReturn(1);
        \$this->entity->getCreatedBy()->willReturn(\$this->user->reveal())->shouldBeCalled();

        \$this->repository->selectById(1)->willReturn(\$this->entity->reveal())->shouldBeCalled();

        \$resultSet = \$this->service->selectById(1);
        \$this->assertInstanceOf('{$module}\Entity\\$class', \$resultSet);
        \$this->assertEquals(1, \$resultSet->getId{$class}());
    }

EOS;
    }

    /**
     * Ignored on this Type
     */
    public function renderSelectAll(array $options)
    {
        $class = $options['class'***REMOVED***;

        return <<<EOS

    public function testSelectAll()
    {
        \$this->service->setRouteMatch(
            \$this->getRouteMatch(1, 'id{$class}', 'DESC')
        );

        \$input = [
            [
                'id{$class}' => 5,
                'createdBy' => [
                    'idUser' => 3
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        \$expected = [
            [
                'id{$class}' => 5,
                'user' => 3,
                'createdBy' => [
                    'idUser' => 3
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        \$this->repository->selectAll([***REMOVED***, 'id{$class}', 'DESC')->willReturn(\$input)->shouldBeCalled();

        \$data = \$this->service->selectAll();

        \$this->assertEquals(\$expected, \$data);
    }

    public function testSelectAllNull()
    {
        \$this->service->setRouteMatch(
            \$this->getRouteMatch(1, 'id{$class}', 'DESC')
        );

        \$input = [***REMOVED***;

        \$this->repository->selectAll([***REMOVED***, 'id{$class}', 'DESC')->willReturn(\$input)->shouldBeCalled();

        \$data = \$this->service->selectAll();

        \$this->assertEquals(\$input, \$data);
    }

EOS;
    }
}
