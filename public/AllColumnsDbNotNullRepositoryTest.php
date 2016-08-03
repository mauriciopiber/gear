<?php
namespace MyModuleTest\RepositoryTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceManager;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group MyModule
 * @group AllColumnsDbNotNull
 * @group Repository1
 */
class AllColumnsDbNotNullRepositoryTest extends TestCase
{
    static public $varcharUploadImage = '/public/upload/all-columns-db-not-null-varcharUploadImageNotNull';

    public function setUp()
    {
        parent::setUp();

        $this->repository = new \MyModule\Repository\AllColumnsDbNotNullRepository();
        $this->entityManager = $this->prophesize('Doctrine\ORM\EntityManager');
        $this->repository->setEntityManager($this->entityManager->reveal());
        $this->entityRepository = $this->prophesize('Doctrine\ORM\EntityRepository');
        $this->repository->setRepository($this->entityRepository->reveal());
        $this->queryBuilder = $this->prophesize('GearBase\Repository\QueryBuilder');
        $this->repository->setQueryBuilder($this->queryBuilder->reveal());

        $this->userMock = $this->getUserMock();
    }

    public function getUserMock()
    {
        $this->entity = $this->prophesize('GearAdmin\Entity\User');
        $this->entity->getIdUser()->willReturn(1);

        $this->serviceManager = new ServiceManager;

        $this->authService = $this->getAuthServiceMock();

        $this->serviceManager->setService('zfcuser_auth_service', $this->authService);

        $this->repository->setServiceLocator($this->serviceManager);

        $this->entityRepository->findOneBy(['idUser' => 1***REMOVED***)->willReturn($this->entity->reveal());

        $this->entityManager->getRepository('GearAdmin\Entity\User')->willReturn($this->entityRepository->reveal());

        return $this->entity->reveal();
    }

    public function getAuthServiceMock()
    {
        $this->entity = $this->prophesize('GearAdmin\Entity\User');
        $this->entity->getIdUser()->willReturn(1);

        $this->authService = $this->prophesize('Zend\Authentication\AuthenticationService');
        $this->authService->hasIdentity()->willReturn(true);
        $this->authService->getIdentity()->willReturn($this->entity->reveal());

        return $this->authService->reveal();
    }

    /**
     * @group t2
     */
    public function testGetUser()
    {
        $user = $this->repository->getUser();
        $this->assertEquals(1, $user->getIdUser());
    }

    /**
     * @group t2
     */
    public function testSelectAll()
    {
        $resultSet = $this->repository->selectAll();
        $this->assertNull($resultSet);
    }

    /**
     * @group t2
     */
    public function testSelectByIdReturnEntity()
    {
        $entity = $this->prophesize('MyModule\Entity\AllColumnsDbNotNull');
        $entity->getIdAllColumnsDbNotNull()->willReturn(1)->shouldBeCalled();

        $this->entityRepository->findOneBy(['idAllColumnsDbNotNull' => 1***REMOVED***)->willReturn($entity)->shouldBeCalled();

        $resultSet = $this->repository->selectById(1);
        $this->assertNotNull($resultSet);
        $this->assertInstanceOf('MyModule\Entity\AllColumnsDbNotNull', $resultSet);

        $this->assertEquals(1, $resultSet->getIdAllColumnsDbNotNull());
    }

    /**
     * @group t2
     */
    public function testSelectByIdReturnNull()
    {
        $this->entityRepository->findOneBy(['idAllColumnsDbNotNull' => 60000***REMOVED***)->willReturn(null)->shouldBeCalled();

        $resultSet = $this->repository->selectById(60000);
        $this->assertNull($resultSet);
    }

    /**
     * @group t2
     */
    public function testSelectOneByIdMyController()
    {
        $entity = $this->prophesize('MyModule\Entity\AllColumnsDbNotNull');
        $entity->getIdAllColumnsDbNotNull()->willReturn(15)->shouldBeCalled();

        $this->entityRepository->findOneBy(['idAllColumnsDbNotNull' => 15***REMOVED***)->willReturn($entity)->shouldBeCalled();

        $resultSet = $this->repository->selectOneBy(
            array(
                'idAllColumnsDbNotNull' =>
                    15
            )
        );
        $this->assertInstanceOf('MyModule\Entity\AllColumnsDbNotNull', $resultSet);
        $this->assertEquals(
            15,
            $resultSet->getIdAllColumnsDbNotNull()
        );
    }

    /**
     * @group t2
     */
    public function testSelectAllOrderByIdMyControllerASC()
    {
        //$entity = $this->prophesize('MyModule\Entity\AllColumnsDbNotNull');
        //$entity->getIdAllColumnsDbNotNull()->willReturn(1)->shouldBeCalled();


        $resultSet = $this->repository->selectAll(
            array(),
            'idAllColumnsDbNotNull',
            'ASC'
        );

        $this->assertNull($resultSet);
    }

    /**
     * @group t2
     */
    public function testSelectAllOrderByIdMyControllerDESC()
    {

        $resultSet = $this->repository->selectAll(
            array(),
            'idAllColumnsDbNotNull',
            'DESC'
        );
        $this->assertNull($resultSet);
    }

    /**
     * @group t2
     */
    public function testCreateNewData()
    {
        $entity = new \MyModule\Entity\AllColumnsDbNotNull();

        $created = new \DateTime('now');

        $this->repository->setTimestamp($created);

        $data = array(
            'varcharUniqueIdNotNull' => 123,
        );

        $hydrator = $this->prophesize('GearBase\Hydrator\DateHydrator');
        $hydrator->hydrate($data, $entity)->willReturn($entity);

        $this->repository->setGearAdminHydrator($hydrator->reveal());
        $this->repository->setTimestamp($created);

        $entityPersist = clone $entity;
        $entityPersist->setVarcharUniqueIdNotNull(123);
        $entityPersist->setCreated($created);
        $entityPersist->setCreatedBy($this->userMock);

        $this->entityManager->persist($entityPersist)->shouldBeCalled();
        $this->entityManager->flush()->shouldBeCalled();

        $resultSet = $this->repository->insert($data);

        $this->assertInstanceOf('MyModule\Entity\AllColumnsDbNotNull', $resultSet);
        $this->assertEquals(null, $resultSet->getIdAllColumnsDbNotNull());
    }

    /**
     * @group t2
     */
    public function testUpdateExistData()
    {
        $created = new \DateTime('now');
        $this->repository->setTimestamp($created);

        $entity = $this->prophesize('MyModule\Entity\AllColumnsDbNotNull');
        $entity->getIdAllColumnsDbNotNull()->willReturn(31);
        $entity->setVarcharUniqueIdNotNull(123)->shouldBeCalled();
        $entity->setUpdated($created)->shouldBeCalled();
        $entity->setUpdatedBy($this->userMock)->shouldBeCalled();

        $this->entityRepository->findOneBy(['idAllColumnsDbNotNull' => 31***REMOVED***)->willReturn($entity);

        $data = array(
            'varcharUniqueIdNotNull' => 123,
        );

        $hydrator = $this->prophesize('GearBase\Hydrator\DateHydrator');
        $hydrator->hydrate($data, $entity)->willReturn($entity);

        $entityPersist = clone $entity;
        $entityPersist->setVarcharUniqueIdNotNull(123);
        $entityPersist->setUpdated($created);
        $entityPersist->setUpdatedBy($this->userMock);

        $this->entityManager->persist($entityPersist)->willReturn(true)->shouldBeCalled();
        $this->entityManager->flush()->willReturn(true)->shouldBeCalled();

        $this->repository->setGearAdminHydrator($hydrator->reveal());

        $resultSet = $this->repository->update(31, $data);

        $this->assertInstanceOf('MyModule\Entity\AllColumnsDbNotNull', $resultSet);
        $this->assertEquals(31, $resultSet->getIdAllColumnsDbNotNull());
    }

    public function testDeleteNoExistData()
    {
        $entityRepository = $this->prophesize('Doctrine\ORM\EntityRepository');
        $entityRepository->findOneBy(['idAllColumnsDbNotNull' => 6000***REMOVED***)->willReturn(null);

        $this->repository->setRepository($entityRepository->reveal());

        $resultSet = $this->repository->delete(6000);
        $this->assertFalse($resultSet);
    }

    public function testDeleteExistData()
    {
        $data = [***REMOVED***;

        $entity = $this->prophesize('MyModule\Entity\AllColumnsDbNotNull');
        $entity->getIdAllColumnsDbNotNull()->willReturn(31);

        $this->entityRepository->findOneBy(['idAllColumnsDbNotNull' => 31***REMOVED***)->willReturn($entity->reveal());

        $this->entityManager->remove($entity)->willReturn(true)->shouldBeCalled();
        $this->entityManager->flush()->willReturn(true)->shouldBeCalled();

        $resultSet = $this->repository->delete($entity);
        $this->assertTrue($resultSet);
    }
}
