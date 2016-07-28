<?php
namespace MyModuleTest\RepositoryTest;

use GearBaseTest\AbstractTestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group MyModule
 * @group IntForeignKey
 * @group Repository
 */
class IntForeignKeyRepositoryTest extends AbstractTestCase
{
    protected $intForeignKey;

    public function getIntForeignKey()
    {
        if (!isset($this->intForeignKey)) {
            $this->intForeignKey =
                $this->bootstrap->getServiceLocator()->get('MyModule\Repository\IntForeignKeyRepository');
        }
        return $this->intForeignKey;
    }

    public function testServiceLocator()
    {
        $serviceLocator = $this->getIntForeignKey()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testCallUsingServiceLocator()
    {
        $intForeignKey = $this->getIntForeignKey();
        $this->assertInstanceOf('MyModule\Repository\IntForeignKeyRepository', $intForeignKey);
    }


    public function testSelectAll()
    {
        $resultSet = $this->getIntForeignKey()->selectAll();
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }


    public function testSelectAllWithBasicFilter()
    {
        $resultSet = $this->getIntForeignKey()->selectAll(array('likeField' => ''));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }

    public function testSelectAllWithBasicFilterFoundNone()
    {
        $resultSet = $this->getIntForeignKey()->selectAll(array('likeField' => 'abcdefAhauhsdfguagdfaf'));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(0, count($resultSet));
    }

    public function testSelectByIdReturnEntity()
    {
        $resultSet = $this->getIntForeignKey()->selectById(1);
        $this->assertNotNull($resultSet);
        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $resultSet);

        $this->assertEquals(1, $resultSet->getIdIntForeignKey());
    }

    public function testSelectByIdReturnNull()
    {
        $resultSet = $this->getIntForeignKey()->selectById(60000);
        $this->assertNull($resultSet);
    }

    public function testDeleteNoExistData()
    {

        $entityRepository = $this->prophesize('Doctrine\\ORM\\EntityRepository');
        $entityRepository->findOneBy(['idIntForeignKey' => 6000***REMOVED***)->willReturn(null);

        $this->getIntForeignKey()->setRepository($entityRepository->reveal());


        $resultSet = $this->getIntForeignKey()->delete(6000);
        $this->assertFalse($resultSet);
    }

    public function testSelectOneByIdIntForeignKey()
    {
        $resultSet = $this->getIntForeignKey()->selectOneBy(
            array(
                'idIntForeignKey' =>
                    15
            )
        );
        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $resultSet);
        $this->assertEquals(
            15,
            $resultSet->getIdIntForeignKey()
        );
    }



    public function testSelectAllOrderByIdIntForeignKeyASC()
    {
        $resultSet = $this->getIntForeignKey()->selectAll(
            array(),
            'idIntForeignKey',
            'ASC'
        );
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals(
            '01',
            $data['idIntForeignKey'***REMOVED***
        );
    }


    public function testSelectAllOrderByIdIntForeignKeyDESC()
    {
        $resultSet = $this->getIntForeignKey()->selectAll(
            array(),
            'idIntForeignKey',
            'DESC'
        );
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals(
            '30',
            $data['idIntForeignKey'***REMOVED***
        );
    }

    /**
     * @group force-90
     */
    public function testCreateNewData()
    {
        $entity = new \MyModule\Entity\IntForeignKey;

        $data = array(
            'depName' => 'insert71 Dep Name',
        );

        $entityManager = $this->prophesize('Doctrine\ORM\EntityManager');
        //$entityManager->persist($entity)->willReturn(true);
        //$entityManager->flush()->willReturn(true);

        $hydrator = $this->prophesize('GearBase\Hydrator\DateHydrator');
        $hydrator->hydrate($data, $entity)->willReturn($entity);

        $this->getIntForeignKey()->setGearAdminHydrator($hydrator->reveal());
        $this->getIntForeignKey()->setEntityManager($entityManager->reveal());


        $resultSet = $this->getIntForeignKey()->insert($data);

        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $resultSet);
        $this->assertEquals(null, $resultSet->getIdIntForeignKey());
    }

    /**
     * @group force-90
     */
    public function testUpdateExistData()
    {
        $entity = $this->getMockBuilder('MyModule\Entity\IntForeignKey', ['getIdIntForeignKey'***REMOVED***)->getMock();
        $entity->expects($this->any())->method('getIdIntForeignKey')->willReturn(31);

        $data = array(
            'depName' => 'insert99 Dep Name',
        );


        $entityManager = $this->prophesize('Doctrine\ORM\EntityManager');
        $entityManager->persist($entity)->willReturn(true);
        $entityManager->flush()->willReturn(true);

        $hydrator = $this->prophesize('GearBase\Hydrator\DateHydrator');
        $hydrator->hydrate($data, $entity)->willReturn($entity);

        $this->getIntForeignKey()->setGearAdminHydrator($hydrator->reveal());

        $this->getIntForeignKey()->setEntityManager($entityManager->reveal());

        $entityRepository = $this->prophesize('Doctrine\\ORM\\EntityRepository');
        $entityRepository->findOneBy(['idIntForeignKey' => 31***REMOVED***)->willReturn($entity);

        $this->getIntForeignKey()->setRepository($entityRepository->reveal());


        $resultSet = $this->getIntForeignKey()
          ->update(31, $data);


        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $resultSet);
        $this->assertEquals(31, $resultSet->getIdIntForeignKey());

    }


    /**
     * @group force-90
     */
    public function testDeleteExistData()
    {
        $entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        $entity->getIdIntForeignKey()->willReturn(31);

        $data = [***REMOVED***;

        $entityRepository = $this->prophesize('Doctrine\\ORM\\EntityRepository');
        $entityRepository->findOneBy(['idIntForeignKey' => 31***REMOVED***)->willReturn($entity->reveal());

        $this->getIntForeignKey()->setRepository($entityRepository->reveal());

        $entityManager = $this->prophesize('Doctrine\ORM\EntityManager');
        $entityManager->remove($entity)->willReturn(true);
        $entityManager->flush()->willReturn(true);

        $this->getIntForeignKey()->setEntityManager($entityManager->reveal());

        $resultSet = $this->getIntForeignKey()->delete($entity);
        $this->assertTrue($resultSet);
    }
}
