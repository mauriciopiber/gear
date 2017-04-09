<?php
namespace Gear\UserType\ServiceTest;

use Gear\UserType\ServiceTest\UserTypeServiceTestInterface;

class All implements UserTypeServiceTestInterface
{
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

    public function renderSelectById(array $options)
    {
        $module = $options['module'***REMOVED***;
        $class = $options['class'***REMOVED***;
        return <<<EOS

    public function testSelectById()
    {
        \$this->entity = \$this->prophesize('{$module}\Entity\\$class');
        \$this->entity->getId{$class}()->willReturn(1);

        \$this->repository->selectById(1)->willReturn(\$this->entity->reveal())->shouldBeCalled();

        \$resultSet = \$this->service->selectById(1);
        \$this->assertInstanceOf('{$module}\Entity\\$class', \$resultSet);
        \$this->assertEquals(1, \$resultSet->getId{$class}());
    }

EOS;

    }

    public function renderSelectByIdNull()
    {
        return '';
    }

    public function renderSelectAll(array $options)
    {
        return '';
    }

    public function renderSelectViewById(array $options)
    {
        return '';
    }

    public function renderSelectByIdReturnInvalid(array $options)
    {
        return '';
    }
}
